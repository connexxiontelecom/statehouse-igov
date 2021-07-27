<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Mail;
use App\Models\MailAttachment;

class CentralRegistryController extends BaseController
{
	public function __construct() {
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
		$this->mail = new Mail();
		$this->mail_attachment = new MailAttachment();
	}

	public function index() {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['mails'] = $this->_get_mails();
		return view('/pages/central-registry/index', $data);
	}

	public function incoming_mail() {
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			return view('/pages/central-registry/new-incoming-mail', $data);
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
			'm_direction' => 1,
		];
		$mail_id = $this->mail->insert($mail_data);
		$attachments = $post_data['m_attachments'];
		if ($mail_id) {
			$this->_upload_attachments($attachments, $mail_id);
			$response['success'] = true;
			$response['message'] = 'Successfully registered the incoming mail';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while registering the incoming mail';
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

	public function manage_mail($mail_id) {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['mail'] = $this->_get_mail($mail_id);
		return view('/pages/central-registry/manage-mail', $data);
	}

	public function file_mail() {
		$post_data = $this->request->getPost();
		$mail_data = [
			'm_id' => $post_data['m_id'],
			'm_file_ref_no' => $post_data['m_file_ref_no'],
			'm_status' => 1
		];
		$filed = $this->mail->save($mail_data);
		if ($filed) {
			$response['success'] = true;
			$response['message'] = 'Successfully filed the incoming mail';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while filing the incoming mail';
		}
		return $this->response->setJSON($response);
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

	private function _get_mails() {
		$mails = $this->mail
			->orderBy('created_at', 'DESC')
			->findAll();
		return $mails;
	}

	private function _get_mail($mail_id) {
		$mail = $this->mail->find($mail_id);
		if ($mail):
			$mail['attachments'] = $this->mail_attachment->where('ma_mail_id', $mail_id)->findAll();
		endif;
		return $mail;
	}
}
