<?php

namespace App\Controllers;

use App\Models\Department;
use App\Models\Mail;
use App\Models\MailAttachment;
use App\Models\MailFiling;
use App\Models\MailTransfer;
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
		$this->mail_transfer = new MailTransfer();
		$this->mail_filing = new MailFiling();
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

	public function transfer_mail() {
		//@TODO include check to ensure the recipient has access to the mail's registry
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
			// @TODO set mail in transit here
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
			$response['success'] = true;
			$response['message'] = 'Successfully filed the mail';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while filing the mail';
		}
		return $this->response->setJSON($response);
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
			$mail['department_employees'] = $this->_get_department_employees_by_registry();
			$mail['holder'] = '';
			$mail['registry'] = $this->registry->find($mail['m_registry_id']);
			$mail['current_desk'] = $this->user->find($mail['m_desk']);
			$mail['stamped_by'] = $this->user->find($mail['m_by']);
			$mail['transfer_logs'] = $this->_get_transfer_logs($mail_id);
		endif;
		return $mail;
	}

	private function _get_department_employees_by_registry() {
		// @TODO check if recipients have access to the registry as well
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
		$transfer_logs = $this->mail_transfer->where('mt_mail_id', $mail_id)->findAll();
		foreach ($transfer_logs as $key => $transfer_log) {
			$transfer_to = $this->user->find($transfer_log['mt_to_id']);
			$transfer_logs[$key]['transfer_to'] = $transfer_to;
		}
		return $transfer_logs;
	}
}