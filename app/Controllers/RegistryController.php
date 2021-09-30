<?php

namespace App\Controllers;

use App\Models\Department;
use App\Models\Mail;
use App\Models\MailAttachment;
use App\Models\MailFiling;
use App\Models\MailTransfer;
use App\Models\Position;
use App\Models\Post;
use App\Models\Registry;
use App\Models\UserModel;
use App\Models\Employee;

class RegistryController extends BaseController
{
	public function __construct()
	{
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
		$this->registry = new Registry();
		$this->mail = new Mail();
		$this->user = new UserModel();
		$this->employee = new Employee();
		$this->position = new Position();
		$this->department = new Department();
		$this->mail_attachment = new MailAttachment();
		$this->mail_transfer = new MailTransfer();
		$this->mail_filing = new MailFiling();
		$this->post = new Post();
	}

	public function index() {

		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['registries'] = $this->_get_registries();
		return view('/pages/registry/index', $data);
	}

	public function view_registry($registry_id = null) {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['mails'] = $this->_get_registry_mails($registry_id);
		$data['unfiled_mails'] = $this->_get_registry_unfiled_mails($registry_id);
		$data['in_transit'] = $this->_get_registry_in_transit_mails($registry_id);
		$data['registry_users'] = $this->_get_registry_users($registry_id);
		$data['registry'] = $this->_get_registry($registry_id);
		return view('/pages/registry/view-registry', $data);
	}

	public function manage_mail($mail_id) {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['mail'] = $this->_get_mail($mail_id);
		return view('/pages/registry/manage-mail', $data);
	}

	public function incoming_mail($registry_id = null) {
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['registry'] = $this->_get_registry($registry_id);
			return view('/pages/registry/new-incoming-mail', $data);
		endif;
		$post_data = $this->request->getPost();
		$mail_data = [
			'm_ref_no' => $post_data['m_ref_no'],
			'm_subject' => $post_data['m_subject'],
			'm_sender' => $post_data['m_sender'],
			'm_date_correspondence' => $post_data['m_date_correspondence'],
			'm_date_received' => $post_data['m_date_received'],
			'm_notes' => $post_data['m_notes'],
			'm_status' => 0,
			'm_by' => $this->session->user_id,
			'm_desk' => $this->session->user_id,
			'm_direction' => 1,
			'm_registry_id' => $registry_id
		];
		$mail_id = $this->mail->insert($mail_data);
		if ($mail_id) {
			if (isset($post_data['m_attachments'])) {
				$attachments = $post_data['m_attachments'];
				$this->_upload_attachments($attachments, $mail_id);
			}
			$this->send_notification('New Incoming Mail', 'You registered a new incoming mail', $this->session->user_id, site_url('manage-mail/').$mail_id, 'click to view mail');
			$registry = $this->registry->find($registry_id);
			$registry_users = json_decode($registry['registry_users']);
			foreach ($registry_users as $registry_user) {
				$this->send_notification('New Incoming Mail', 'A new incoming mail was registered in your registry', $registry_user, site_url('manage-mail/').$mail_id, 'click to view mail');
			}
			$response['success'] = true;
			$response['message'] = 'Successfully registered the incoming mail';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while registering the incoming mail';
		}
		return $this->response->setJSON($response);
	}

	public function outgoing_mail($registry_id = null) {
    if($this->request->getMethod() == 'get'):
      $data['firstTime'] = $this->session->firstTime;
      $data['username'] = $this->session->user_username;
      $data['registry'] = $this->_get_registry($registry_id);
      $data['department_employees'] = $this->_get_department_employees($registry_id);
      $data['external_messages'] = $this->_get_external_messages();
      return view('/pages/registry/new-outgoing-mail', $data);
    endif;
    $post_data = $this->request->getPost();
    $mail_data = [
      'm_ref_no' => $post_data['m_ref_no'],
      'm_subject' => $post_data['m_subject'],
      'm_date_correspondence' => $post_data['m_date_correspondence'],
      'm_date_received' => $post_data['m_date_received'],
      'm_notes' => $post_data['m_notes'],
      'm_status' => 0,
      'm_by' => $this->session->user_id,
      'm_desk' => $this->session->user_id,
      'm_direction' => 2,
      'm_registry_id' => $registry_id,
      'm_source' => $post_data['m_source'],
      'm_post_id' => $post_data['m_post_id'],
    ];
    $mail_id = $this->mail->insert($mail_data);
    if ($mail_id) {
      if (isset($post_data['m_attachments'])) {
        $attachments = $post_data['m_attachments'];
        $this->_upload_attachments($attachments, $mail_id);
      }
	    $this->send_notification('New Outgoing Mail', 'You registered a new outgoing mail', $this->session->user_id, site_url('manage-mail/').$mail_id, 'click to view mail');
	    $registry = $this->registry->find($registry_id);
	    $registry_users = json_decode($registry['registry_users']);
	    foreach ($registry_users as $registry_user) {
		    $this->send_notification('New Outgoing Mail', 'A new outgoing mail was registered in your registry', $registry_user, site_url('manage-mail/').$mail_id, 'click to view mail');
	    }
      $response['success'] = true;
      $response['message'] = 'Successfully registered the outgoing mail';
    } else {
      $response['success'] = false;
      $response['message'] = 'There was an error while registering the outgoing mail';
    }
    return $this->response->setJSON($response);
  }

	public function upload_mail_attachments() {
		$file = $this->request->getFile('file');
		if($file->isValid() && !$file->hasMoved()):
			$file_name = $file->getClientName();
			$file->move('uploads/mails', $file_name);
			echo $file_name;
		endif;
	}

	public function delete_mail_attachments(){
		$file = $this->request->getPostGet('files');
		$directory = 'uploads/mails/'.$file;
		if(unlink($directory)):
			$response['message'] = 'Deleted Successful';
		else:
			$response['message'] = 'An error Occurred';
		endif;
		return $this->response->setJSON($response);
	}

	public function transfer_mail() {
		$post_data = $this->request->getPost();
		$pending_transfer = $this->mail_transfer->where([
			'mt_mail_id' => $post_data['mt_mail_id'],
			'mt_status' => 0
		])->first();
		if ($pending_transfer) {
			$response['success'] = false;
			$response['message'] = 'This mail has a transfer request still pending. Please cancel the pending request before submitting a new transfer request.';
			return $this->response->setJSON($response);
		}
		$mail_transfer_data = [
			'mt_mail_id' => $post_data['mt_mail_id'],
			'mt_from_id' => session()->user_id,
			'mt_to_id' => $post_data['mt_to_id'],
		];
		if ($this->mail_transfer->save($mail_transfer_data)) {
			$this->send_notification('New Mail Transfer', 'You initiated a mail transfer', $this->session->user_id, site_url('manage-mail/').$post_data['mt_mail_id'], 'click to view mail');
			$this->send_notification('New Mail Transfer', 'A mail was transferred to you', $post_data['mt_to_id'], site_url('manage-mail/').$post_data['mt_mail_id'], 'click to view mail');
			$mail = $this->mail->find($post_data['mt_mail_id']);
			$registry = $this->registry->find($mail['m_registry_id']);
			$registry_users = json_decode($registry['registry_users']);
			foreach ($registry_users as $registry_user) {
				$this->send_notification('New Mail Transfer', 'A mail in your registry was transferred', $registry_user, site_url('manage-mail/').$post_data['mt_mail_id'], 'click to view mail');
			}
			$mail_data = [
				'm_id' => $post_data['mt_mail_id'],
				'm_status' => 1
			];
			$this->mail->save($mail_data);
			$response['success'] = true;
			$response['message'] = 'The mail transfer request has been submitted to the recipient.';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while submitting the transfer request to the recipient';
		}
		return $this->response->setJSON($response);
	}

	public function file_mail() {
		$post_data = $this->request->getPost();
		$in_transit = $this->mail_transfer->where([
			'mt_mail_id' => $post_data['mf_mail_id'],
			'mt_status' => 0,
		])->first();
		if ($in_transit) {
			$response['success'] = false;
			$response['message'] = 'The mail cannot be filed with a pending transfer';
			return $this->response->setJSON($response);
		}
		$filed = $this->mail_filing->where([
			'mf_mail_id' => $post_data['mf_mail_id'],
			'mf_status' => 1
		])->first();
		if ($filed) {
			$mail_filing_data = [
				'mf_id' => $filed['mf_id'],
				'mf_status' => 0,
			];
			$this->mail_filing->save($mail_filing_data);
		}
		$mail_filing_data = [
			'mf_mail_id' => $post_data['mf_mail_id'],
			'mf_filed_by_id' => session()->user_id,
			'mf_file_ref_no' => $post_data['mf_file_ref_no'],
			'mf_status' => 1
		];
		if ($this->mail_filing->save($mail_filing_data)) {
			$mail_data = [
				'm_id' => $post_data['mf_mail_id'],
				'm_file_ref_no' => $post_data['mf_file_ref_no'],
				'm_status' => 3
			];
			$this->mail->save($mail_data);
			$this->send_notification('New Mail Filing', 'You filed a mail', $this->session->user_id, site_url('manage-mail/').$post_data['mf_mail_id'], 'click to view mail');
			$mail = $this->mail->find($post_data['mf_mail_id']);
			$registry = $this->registry->find($mail['m_registry_id']);
			$registry_users = json_decode($registry['registry_users']);
			foreach ($registry_users as $registry_user) {
				$this->send_notification('New Mail Filing', 'A mail in your registry was filed', $registry_user, site_url('manage-mail/').$post_data['mf_mail_id'], 'click to view mail');
			}
			$response['success'] = true;
			$response['message'] = 'Successfully filed the mail';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while filing the mail';
		}
		return $this->response->setJSON($response);
	}

	public function view_transfer_log($mail_id) {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['mail'] = $this->_get_mail($mail_id);
		$data['transfer_logs'] = $this->_get_transfer_logs($mail_id);
		return view('/pages/registry/mail-transfer-log', $data);
	}

	public function view_filing_log($mail_id) {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['mail'] = $this->_get_mail($mail_id);
		$data['filing_logs'] = $this->_get_filing_logs($mail_id);
		return view('/pages/registry/mail-filing-log', $data);
	}

	public function mail_transfer_requests() {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['transfer_requests'] = $this->_get_transfer_requests();
		return view('/pages/registry/mail-transfer-requests', $data);
	}

	public function confirm_transfer_request() {
		$post_data = $this->request->getPost();
		$transfer_request = $this->mail_transfer->where([
			'mt_id' => $post_data['mt_id'],
			'mt_status' => 0
		])->first();
		if (!$transfer_request) {
			$response['success'] = false;
			$response['message'] = 'This transfer request is not valid';
			return $this->response->setJSON($response);
		}
		$transfer_request_data = [
			'mt_id' => $transfer_request['mt_id'],
			'mt_status' => 1,
			'mt_confirmed_at' => date('Y-m-d H:i:s', time())
		];
		if ($this->mail_transfer->save($transfer_request_data)) {
			$mail = $this->mail->find($transfer_request['mt_mail_id']);
			if ($mail) {
				$mail_data = [
					'm_id' => $mail['m_id'],
					'm_desk' => $transfer_request['mt_to_id'],
					'm_status' => 2
				];
				if ($this->mail->save($mail_data)) {
					$this->send_notification('Mail Transfer Confirmed', 'You confirmed a mail transfer', $this->session->user_id, site_url('manage-mail/').$transfer_request['mt_mail_id'], 'click to view mail');
					$this->send_notification('Mail Transfer Confirmed', 'Your mail transfer was confirmed', $transfer_request['mt_from_id'], site_url('manage-mail/').$transfer_request['mt_mail_id'], 'click to view mail');
					$mail = $this->mail->find($transfer_request['mt_mail_id']);
					$registry = $this->registry->find($mail['m_registry_id']);
					$registry_users = json_decode($registry['registry_users']);
					foreach ($registry_users as $registry_user) {
						$this->send_notification('Mail Transfer Confirmed', 'A mail transfer was confirmed', $registry_user, site_url('manage-mail/').$transfer_request['mt_mail_id'], 'click to view mail');
					}
					$response['success'] = true;
					$response['message'] = 'The transfer request was successfully confirmed';
				} else {
					$response['success'] = false;
					$response['message'] = 'An error occurred while confirming the transfer request';
				}
			} else {
				$response['success'] = false;
				$response['message'] = 'An error occurred while confirming the transfer request';
			}
		} else {
			$response['success'] = false;
			$response['message'] = 'An error occurred while confirming the transfer request';
		}
		return $this->response->setJSON($response);
	}

	public function correspondence() {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['mails'] = $this->_get_user_mails();
		$transfer_requests = $this->_get_transfer_requests();
		$data['transfer_requests'] = $transfer_requests;
		if ($transfer_requests)
		  session()->setFlashdata('transfer_requests', true);
    return view('/pages/registry/correspondence', $data);
	}

	private function _get_registries() {
		$registries = $this->registry->where('registry_status', 1)->findAll();
		foreach ($registries as $key => $registry) {
			$authorised_users = json_decode($registry['registry_users']);
			if (!in_array(session()->user_id, $authorised_users)) {
				unset($registries[$key]);
			}
		}
		return $registries;
	}

	private function _get_registry($registry_id) {
		return $this->registry->find($registry_id);
	}

	private function _get_registry_users($registry_id) {
		$registry = $this->registry->find($registry_id);
		$users = json_decode($registry['registry_users']);
		$registry_users = [];
		foreach ($users as $user) {
			array_push($registry_users, $this->user->find($user));
		}
		return $registry_users;
	}

	private function _get_registry_mails($registry_id) {
		return $this->mail->where('m_registry_id', $registry_id)->findAll();
	}

	private function _get_registry_unfiled_mails($registry_id) {
		return $this->mail
			->where('m_status !=', 3)
			->where('m_registry_id', $registry_id)
		->findAll();
	}

	private function _get_registry_in_transit_mails($registry_id) {
		return $this->mail
			->where('m_status', 1)
			->where('m_registry_id', $registry_id)
		->findAll();
	}



	private function _get_user_mails() {
		return $this->mail->where('m_desk', session()->user_id)->findAll();
	}

	private function _get_mail($mail_id) {
		$mail = $this->mail->find($mail_id);
		if ($mail):
			$mail['attachments'] = $this->mail_attachment->where('ma_mail_id', $mail_id)->findAll();
			$mail['department_employees'] = $this->_get_department_employees($mail['m_registry_id']);
			$mail['registry'] = $this->registry->find($mail['m_registry_id']);
			$mail['current_desk'] = $this->user->find($mail['m_desk']);
			$mail['stamped_by'] = $this->user->find($mail['m_by']);
			if ($mail['m_source']) $mail['source'] = $this->user->find($mail['m_source']);
			if ($mail['m_post_id']) $mail['post'] = $this->post->find($mail['m_post_id']);
 			$mail['transfer_logs'] = $this->_get_transfer_logs($mail_id);
		endif;
		return $mail;
	}

	private function _get_department_employees($registry_id) {
		$department_employees = [];
		$departments = $this->department->findAll();
		foreach ($departments as $department) {
			$department_employees[$department['dpt_name']] = [];
			$employees = $this->employee
				->where('employee_department_id', $department['dpt_id'])
				->findAll();
			foreach ($employees as $employee) {
				$user = $this->user->where('user_employee_id', $employee['employee_id'])->first();
				if ($user['user_status'] == 1 && ($user['user_type'] == 3 || $user['user_type'] == 2)) {
					$employee['user'] = $user;
					$employee['position'] = $this->position->find($employee['employee_position_id']);
					array_push($department_employees[$department['dpt_name']], $employee);
				}
			}
		}
		return $department_employees;
	}

	private function _get_transfer_logs($mail_id) {
		$transfer_logs = $this->mail_transfer->where('mt_mail_id', $mail_id)->orderBy('created_at', 'DESC')->findAll();
		foreach ($transfer_logs as $key => $transfer_log) {
			$transfer_from = $this->user->find($transfer_log['mt_from_id']);
			$transfer_to = $this->user->find($transfer_log['mt_to_id']);
			$transfer_logs[$key]['transfer_from'] = $transfer_from;
			$transfer_logs[$key]['transfer_to'] = $transfer_to;
		}
		return $transfer_logs;
	}

	private function _get_filing_logs($mail_id) {
		$filing_logs = $this->mail_filing->where('mf_mail_id', $mail_id)->orderBy('created_at', 'DESC')->findAll();
		foreach ($filing_logs as $key => $filing_log) {
			$filed_by = $this->user->find($filing_log['mf_filed_by_id']);
			$filing_logs[$key]['filed_by'] = $filed_by;
		}
		return $filing_logs;
	}

	private function _upload_attachments($attachments, $mail_id) {
		if (count($attachments) > 0) {
			foreach ($attachments as $attachment) {
				$attachment_data = array(
					'ma_mail_id' => $mail_id,
					'ma_link' => $attachment
				);
				$this->mail_attachment->save($attachment_data);
			}
		}
	}

	private function _get_transfer_requests() {
		$transfer_requests = $this->mail_transfer
			->where('mt_to_id', session()->user_id)
			->where('mt_status', 0)
		->findAll();
		foreach ($transfer_requests as $key => $transfer_request) {
			$mail = $this->mail->find($transfer_request['mt_mail_id']);
			$registry = $this->registry->find($mail['m_registry_id']);
			$transfer_from = $this->user->find($transfer_request['mt_from_id']);
			$transfer_to = $this->user->find($transfer_request['mt_to_id']);
			$transfer_requests[$key]['mail'] = $mail;
			$transfer_requests[$key]['registry'] = $registry;
			$transfer_requests[$key]['transfer_from'] = $transfer_from;
			$transfer_requests[$key]['transfer_to'] = $transfer_to;
		}
		return $transfer_requests;
	}

	private function _get_external_messages() {
	  $posts = $this->post
      ->where('p_direction', 2)
      ->where('p_status', 2)
    ->findAll();
	  $external_messages = array('Circulars' => [], 'Memos' => [], 'Notices' => []);
	  foreach ($posts as $post) {
	    if ($post['p_type'] == 1) array_push($external_messages['Memos'], $post);
	    if ($post['p_type'] == 2) array_push($external_messages['Circulars'], $post);
	    if ($post['p_type'] == 3) array_push($external_messages['Notices'], $post);
    }
	  return $external_messages;
  }
}