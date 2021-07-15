<?php

namespace App\Controllers;

use App\Models\Department;
use App\Models\Organization;
use App\Models\Position;
use App\Models\Employee;
use App\Models\UserModel;
use App\Models\Verification;

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
		$this->verification = new Verification();
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
			$verified = $this->verification->where([
				'ver_user_id' => session()->user_id,
				'ver_type' => 'e-signature',
				'ver_status' => 1
			])->first();
			if ($verified) {
				$response['success'] = true;
				$response['message'] = $employee['employee_signature'];
			} else {
				$response['success'] = false;
				$response['message'] = 'Your E-Signature has been set up but is not verified yet. You will be redirected to My Account to verify it now.';
			}
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
					$to = $employee['employee_mail'];
					$subject = 'Verify E-Signature';
					$data['subject'] = $subject;
					$data['user'] = $user['user_name'];
					$data['organization'] = $organization['org_name'];
					$data['ver_code'] = $this->_get_verification_code();
					$message = view('email/signature-otp', $data);
					$from['name'] = 'IGOV by Connexxion Telecom';
					$from['email'] = 'support@connexxiontelecom.com';
					if ($this->send_mail($to, $subject, $message, $from)) {
						$response['success'] = true;
						$response['message'] = 'An E-Signature verification code has been sent to your email.';
					} else {
						$response['success'] = false;
						$response['message'] = 'An error occurred while sending your E-Signature verification code';
					}
				} else {
					$response['success'] = false;
					$response['message'] = 'Your E-Signature has not been set up yet. You will be redirected to My Account to set it up now.';
				}
			}
		}
		return $this->response->setJSON($response);
	}

	public function verify_signature() {
		$post_data = $this->request->getPost();
		$ver_code = $post_data['ver_code'];
		$verification = $this->verification->where([
			'ver_user_id' => session()->user_id,
			'ver_type' => 'e-signature',
			'ver_code' => $ver_code,
			'ver_status' => 0
		])->first();
		if ($verification) {
			$verification_data = [
				'ver_id' => $verification['ver_id'],
				'ver_status' => 1,
			];
			$this->verification->save($verification_data);
			$response['success'] = true;
			$response['message'] = 'Your E-Signature is successfully verified.';
		} else {
			$response['success'] = false;
			$response['message'] = 'An error occurred while verifying your e-signature.';
		}
		return $this->response->setJSON($response);
	}

	private function _get_employee_detail() {
		$user = $this->user->find(session()->user_id);
		$user['employee'] = $this->employee->find($user['user_employee_id']);
		$user['department'] = $this->department->find($user['employee']['employee_department_id']);
		$user['position'] = $this->position->find($user['employee']['employee_position_id']);
		$user['organization'] = $this->organization->first();
		$user['signature_ver'] = $this->verification->where([
			'ver_user_id' => session()->user_id,
			'ver_type' => 'e-signature'
		])->first();
		return $user;
	}

	private function _get_verification_code() {
		$ver_code = bin2hex(random_bytes(4));
		$verification_data = [
			'ver_user_id' => session()->user_id,
			'ver_type' => 'e-signature',
			'ver_code' => $ver_code,
			'ver_status' => 0,
		];
		$verification = $this->verification->where([
			'ver_user_id' => session()->user_id,
			'ver_type' => 'e-signature'
		])->first();
		if ($verification) {
			$verification_data['ver_id'] = $verification['ver_id'];
		}
		$this->verification->save($verification_data);
		return $ver_code;
	}
}
