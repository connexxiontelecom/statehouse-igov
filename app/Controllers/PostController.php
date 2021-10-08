<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Notice;
use App\Models\Organization;
use App\Models\Position;
use App\Models\Post;
use App\Models\PostAttachment;
use App\Models\Token;
use App\Models\UserModel;
use App\Models\Verification;

class PostController extends BaseController
{
	public function __construct()
	{
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
		$this->notice = new Notice();
		$this->user = new UserModel();
		$this->post = new Post();
		$this->employee = new Employee();
		$this->department = new Department();
		$this->position = new Position();
		$this->pa = new PostAttachment();
		$this->organization = new Organization();
		$this->verification = new Verification();
		$this->token = new Token();
	}

	public function upload_post_attachments(){
		$file = $this->request->getFile('file');
		if($file->isValid() && !$file->hasMoved()):
			$file_name = $file->getClientName();
			$file->move('uploads/posts', $file_name);
			echo $file_name;
		endif;

	}

	public function delete_post_attachments(){
	$file = $this->request->getPostGet('files');
	$directory = 'uploads/posts/'.$file;
		if(unlink($directory)):

			$response['message'] = 'Deleted Successful';
		else:
			$response['message'] = 'An error Occurred';
			endif;
		return $this->response->setJSON($response);
	}

	public function send_doc_signing_verification() {
		$post_data = $this->request->getPost();
		$post_id = $post_data['p_id'];
		$post = $this->post->find($post_id);
		$user = $this->user->find(session()->user_id);
		$employee = $this->employee->find($user['user_employee_id']);
		$organization = $this->organization->first();
		$to = $employee['employee_mail'];
		$phone = $employee['employee_phone'];
		$phone = '234'.substr($phone, 1, strlen($phone));
		$subject = 'Verify Document Signing';
		$data['subject'] = $subject;
		$data['user'] = $user['user_name'];
		$data['organization'] = $organization['org_name'];
		$code = $this->_get_verification_code('doc_signing');
		$data['ver_code'] = $code;
		$data['post'] = $post;
		$message = view('email/doc-signing-otp', $data);
		$from['name'] = 'IGOV by Connexxion Telecom';
		$from['email'] = 'support@connexxiontelecom.com';
		
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://termii.com/api/sms/send',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>' {
          "to": "'.$phone.'",
           "from": "N-Alert",
           "sms": "Your iGov confirmation code is: '.$code.' It expires in 10 Mins",
           "type": "plain",
           "channel": "dnd",
           "api_key": "TLfrtWYbF5uWb0GLWjwDigrMb722yJgAp2B3jDoYYRzYOSjIU3PHwRIpGSZlga"
                }',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));
		
		$responses = curl_exec($curl);
		
		curl_close($curl);
		//echo $responses;
		if ($this->send_mail($to, $subject, $message, $from)) {
			$response['success'] = true;
			$response['message'] = 'A document signing verification code has been sent to your email.';
		} else {
			$response['success'] = false;
			$response['message'] = 'An error occurred while sending your document signing verification code';
			echo $this->email->printDebugger();
		}
		return $this->response->setJSON($response);
	}

	public function sign_post() {
		$post_request_data = $this->request->getPost();
		$post = $this->post->find($post_request_data['p_id']);
		if ($post['p_signed_by'] != session()->user_id) {
			$response['success'] = false;
			$response['message'] = 'You have not been assigned to sign this document.';
			return $this->response->setJSON($response);
		} else if ($post['p_status'] != 0) {
			$response['success'] = false;
			$response['message'] = 'This document has been processed. No further actions can be taken at this time.';
			return $this->response->setJSON($response);
		}
		// check verification code
		$ver_code = $post_request_data['ver_code'];
		$verification = $this->verification->where([
			'ver_user_id' => session()->user_id,
			'ver_type' => 'doc_signing',
			'ver_code' => $ver_code,
			'ver_status' => 0
		])->first();
		$token = $this->token->where([
			'token_symbol' => $ver_code,
			'token_user_id' => $this->session->user_id,
		])->first();
		if ($verification || $token) {
			$verification_data = [
				'ver_id' => $verification['ver_id'],
				'ver_status' => 1,
			];
			$this->verification->save($verification_data);
			$post_data = [
				'p_id' => $post_request_data['p_id'],
				'p_status' => 2,
				'p_signature' => $post_request_data['p_signature']
			];
			if ($this->post->save($post_data)) {
				$this->_create_post_sign_notification($post_request_data);
				$response['success'] = true;
				$response['message'] = 'The document was signed successfully';
			} else {
				$response['success'] = false;
				$response['message'] = 'An error occurred while signing this document';
			}
		} else {
			$response['success'] = false;
			$response['message'] = 'The verification code you entered is not valid';
		}
		return $this->response->setJSON($response);
	}

	public function decline_post() {
		$post_request_data = $this->request->getPost();
		$post = $this->post->find($post_request_data['p_id']);
		if ($post['p_signed_by'] != session()->user_id) {
			$response['success'] = false;
			$response['message'] = 'You have not been assigned to sign this document.';
			return $this->response->setJSON($response);
		} else if ($post['p_status'] != 0) {
			$response['success'] = false;
			$response['message'] = 'This document has been processed. No further actions can be taken at this time.';
			return $this->response->setJSON($response);
		}
		$post_data = [
			'p_id' => $post_request_data['p_id'],
			'p_status' => 4,
		];
		if ($this->post->save($post_data)) {
			$this->_create_post_decline_notification($post_request_data);
			$response['success'] = true;
			$response['message'] = 'The document was successfully declined';
		} else {
			$response['success'] = false;
			$response['message'] = 'An error occurred while declining this document';
		}
		return $this->response->setJSON($response);
	}

	protected function _upload_attachments($attachments, $post_id) {
		if (count($attachments) > 0) {
			foreach ($attachments as $attachment) {
				$attachment_data = array(
					'pa_post_id' => $post_id,
					'pa_link' => $attachment
				);
				$this->pa->save($attachment_data);
			}
		}
	}

	private function _create_post_sign_notification($post) {
		$recipients = json_decode($post['p_recipients_id']);
		if ($post['p_type'] == 1) {
			$this->send_notification('New Memo Signing', 'You successfully signed a memo', $this->session->user_id, site_url('view-memo/').$post['p_id'], 'click to view memo');
			foreach ($recipients as $recipient) {
				$this->send_notification('New Memo Signing', 'A memo addressed to you was signed and approved', $recipient, site_url('view-memo/').$post['p_id'], 'click to view memo');
			}
		} else if ($post['p_type'] == 2) {
			$this->send_notification('New Circular Signing', 'You successfully signed a circular', $this->session->user_id, site_url('view-circular/').$post['p_id'], 'click to view circular');
			foreach ($recipients as $recipient) {
				$department_users = $this->employee->where('employee_department_id', $recipient)->findAll();
				foreach ($department_users as $department_user) {
					$user = $this->user->where('user_employee_id', $department_user['employee_id'])->findAll();
					$this->send_notification('New Circular Signing', 'A circular addressed to you was signed and approved', $user['user_id'], site_url('view-circular/').$post['p_id'], 'click to view circular');
				}
			}
		} else {
			$this->send_notification('New Notice Signing', 'You successfully signed a notice', $this->session->user_id, site_url('view-notice/').$post['p_id'], 'click to view notice');
			$users = $this->user->findAll();
			foreach ($users as $user) {
				$this->send_notification('New Notice Signing', 'A notice was signed and approved', $user['user_id'], site_url('view-notice/').$post['p_id'], 'click to view notice');
			}
		}
	}

	private function _create_post_decline_notification($post) {
		if ($post['p_type'] == 1) {
			$this->send_notification('Memo Declined', 'You successfully declined a memo', $this->session->user_id, site_url('view-memo/').$post['p_id'], 'click to view memo');
			$this->send_notification('Memo Declined', 'A memo you created was declined', $post['p_by'], site_url('view-memo/').$post['p_id'], 'click to view memo');
		} else if ($post['p_type'] == 2) {
			$this->send_notification('Circular Declined', 'You successfully declined a circular', $this->session->user_id, site_url('view-circular/').$post['p_id'], 'click to view circular');
			$this->send_notification('Circular Declined', 'A circular you created was declined', $post['p_by'], site_url('view-circular/').$post['p_id'], 'click to view circular');
		} else {
			$this->send_notification('Notice Declined', 'You successfully declined a notice', $this->session->user_id, site_url('view-notice/').$post['p_id'], 'click to view notice');
			$this->send_notification('Notice Declined', 'A notice you created was declined', $post['p_by'], site_url('view-notice/').$post['p_id'], 'click to view notice');
		}
	}
}
