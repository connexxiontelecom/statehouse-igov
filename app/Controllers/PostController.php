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
use App\Models\UserModel;

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
		$subject = 'Verify Document Signing';
		$data['subject'] = $subject;
		$data['user'] = $user['user_name'];
		$data['organization'] = $organization['org_name'];
		$data['ver_code'] = $this->_get_verification_code('doc_signing');
		$data['post'] = $post;
		$message = view('email/doc-signing-otp', $data);
		$from['name'] = 'IGOV by Connexxion Telecom';
		$from['email'] = 'support@connexxiontelecom.com';
		if ($this->send_mail($to, $subject, $message, $from)) {
			$response['success'] = true;
			$response['message'] = 'A document signing verification code has been sent to your email.';
		} else {
			$response['success'] = false;
			$response['message'] = 'An error occurred while sending your document signing verification code';
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
		if ($verification) {
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
}
