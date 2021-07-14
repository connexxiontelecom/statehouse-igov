<?php

namespace App\Controllers;

use App\Models\Department;
use App\Models\Organization;
use App\Models\Position;
use App\Models\Employee;
use App\Models\UserModel;

class EmployeeController extends BaseController
{
	public function __construct() {
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
		$this->organization = new Organization();
		$this->department = new Department();
		$this->position = new Position();
		$this->employee = new Employee();
		$this->user = new UserModel();
	}

	public function my_account() {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['user'] = $this->_get_employee_detail();
		return view('/pages/employee/my-account', $data);
	}

	public function check_signature_exists() {
		$user = $this->user->find(session()->user_id);
		$employee = $this->employee->find($user['user_employee_id']);
		if ($employee['employee_signature']) {

			$response['success'] = true;
			$response['message'] = $employee['employee_signature'];
		} else {
			$response['success'] = false;
			$response['message'] = 'Your E-Signature has not been set up yet. You will be redirected to My Account to set it up now.';
		}
		return $this->response->setJSON($response);
	}

	public function setup_signature() {
		$user = $this->user->find(session()->user_id);
		$employee = $this->employee->find($user['user_employee_id']);
		$organization = $this->organization->first();
		$file = $this->request->getFile('file');
		if (!empty($file)) {
			if($file->isValid() && !$file->hasMoved()) {
				$file_name = $file->getRandomName();
				$file->move('uploads/signatures', $file_name);
				$employee_data = [
					'employee_id' => $employee['employee_id'],
					'employee_signature' => $file_name
				];
				if ($this->employee->save($employee_data)) {
					$to = 'oamanambu@yahoo.com';
					$subject = 'Verify E-Signature';
					$data['subject'] = $subject;
					$data['user'] = $user['user_name'];
					$data['organization'] = $organization['org_name'];
					$message = view('email/signature-otp', $data);
					$from['name'] = 'IGOV by Connexxion Telecom';
					$from['email'] = 'support@connexxiontelecom.com';
					if ($this->send_mail($to, $subject, $message, $from)) {
						$response['success'] = true;
						$response['message'] = 'An E-Signature Verification OTP has been sent. Please, verify that it is you performing this action.';
					} else {
						$response['success'] = false;
						$response['message'] = 'An error occurred while sending your E-Signature Verification';
					}
				} else {
					$response['success'] = false;
					$response['message'] = 'Your E-Signature has not been set up yet. You will be redirected to My Account to set it up now.';
				}
			}
		}
		return $this->response->setJSON($response);
	}

	private function _get_employee_detail() {
		$user = $this->user->find(session()->user_id);
		$user['employee'] = $this->employee->find($user['user_employee_id']);
		$user['department'] = $this->department->find($user['employee']['employee_department_id']);
		$user['position'] = $this->position->find($user['employee']['employee_position_id']);
		$user['organization'] = $this->organization->first();
		return $user;
	}
}
