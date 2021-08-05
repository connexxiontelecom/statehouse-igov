<?php

namespace App\Controllers;

use App\Models\Department;
use App\Models\Mail;
use App\Models\MailAttachment;
use App\Models\Position;
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
	}

	public function index() {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		// @TODO get only the registries the current user has access to
		$data['registries'] = $this->_get_registries();
//		$data['registries'] = array();
		return view('/pages/registry/index', $data);
	}

	public function view_registry($registry_id = null) {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['mails'] = $this->_get_user_registry_mails($registry_id);
		$data['registry'] = $this->_get_registry($registry_id);
		return view('/pages/registry/view-registry', $data);
	}

	public function manage_mail($mail_id) {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['mail'] = $this->_get_mail($mail_id);
		return view('/pages/registry/manage-mail', $data);
	}

	private function _get_registries() {
		$registries = $this->registry->findAll();
		foreach ($registries as $key => $registry) {
			$manager_user = $this->user->find($registry['registry_manager_id']);
			$manager_employee = $this->employee->find($manager_user['user_employee_id']);
			$manager_position = $this->position->find($manager_employee['employee_position_id']);
			$manager_department = $this->department->find($manager_employee['employee_department_id']);
			$registries[$key]['manager'] = $manager_user;
			$registries[$key]['position'] = $manager_position;
			$registries[$key]['department'] = $manager_department;
		}
		return $registries;
	}

	private function _get_registry($registry_id) {
		$registry = $this->registry->find($registry_id);
		$manager_user = $this->user->find($registry['registry_manager_id']);
		$manager_employee = $this->employee->find($manager_user['user_employee_id']);
		$manager_position = $this->position->find($manager_employee['employee_position_id']);
		$manager_department = $this->department->find($manager_employee['employee_department_id']);
		$registry['manager'] = $manager_user;
		$registry['position'] = $manager_position;
		$registry['department'] = $manager_department;
		return $registry;
	}

	private function _get_user_registry_mails($registry_id) {
		return $this->mail
			->where('m_desk', session()->user_id)
			->where('m_registry_id', $registry_id)
		->findAll();
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
			$mail['holder'] = '';
			$mail['registry'] = $this->registry->find($mail['m_registry_id']);
			$mail['current_desk'] = $this->user->find($mail['m_desk']);
			$mail['stamped_by'] = $this->user->find($mail['m_by']);
		endif;
		return $mail;
	}
}