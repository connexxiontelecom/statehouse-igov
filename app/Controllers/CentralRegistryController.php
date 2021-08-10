<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Mail;
use App\Models\MailAttachment;
use App\Models\MailHolder;
use App\Models\UserModel;

class CentralRegistryController extends BaseController
{
	public function __construct() {
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
		$this->mail = new Mail();
		$this->mail_attachment = new MailAttachment();
		$this->mail_holder = new MailHolder();
		$this->user = new UserModel();
	}

	public function index() {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['mails'] = $this->_get_mails();
		return view('/pages/central-registry/index', $data);
	}


	public function outgoing_mail() {
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			return view('/pages/central-registry/new-outgoing-mail', $data);
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
			'm_direction' => 2,
		];
		$mail_id = $this->mail->insert($mail_data);
		if ($mail_id) {
			if (isset($post_data['m_attachments'])) {
				$attachments = $post_data['m_attachments'];
				$this->_upload_attachments($attachments, $mail_id);
			}
			$this->_set_file_holder(session()->user_id, $mail_id);
			$response['success'] = true;
			$response['message'] = 'Successfully registered the outgoing mail';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while registering the outgoing mail';
		}
		return $this->response->setJSON($response);
	}



	public function manage_mail($mail_id) {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['mail'] = $this->_get_mail($mail_id);

		return view('/pages/central-registry/manage-mail', $data);
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
			$mail['recipients'] = $this->user->where('user_status', 1)
				->groupStart()
					->where('user_type', 2)
					->orWhere('user_type', 3)
				->groupEnd()
			->findAll();
			$holder = $this->mail_holder->where([
				'mh_mail_id' => $mail_id,
				'mh_status' => 1
			])->first();
			if ($holder)
				$mail['holder'] = $this->user->find($holder['mh_holder_id']);
			else
				$mail['holder'] = '';
		endif;
		return $mail;
	}


}
