<?php

namespace App\Controllers;

use App\Models\Department;
use App\Models\Organization;
use App\Models\Position;
use App\Models\Employee;
use App\Models\Token;
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
		$this->token = new Token();
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
		$phone = $employee['employee_phone'];
		$phone = '234'.substr($phone, 1, strlen($phone));
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
					$data['ver_code'] = $code = $this->_get_verification_code('e-signature');
					
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
							           "sms": "Your iGov signature code is: '.$code.' It expires in 10 Mins",
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
					
//					$response['success'] = true;
//					$response['message'] = $responses;
					
					
					$message = view('email/signature-otp', $data);
					$from['name'] = 'IGOV by Connexxion Telecom';
					$from['email'] = 'support@connexxiontelecom.com';
					if ($this->send_mail($to, $subject, $message, $from)) {
						$response['success'] = true;
						$response['message'] = 'An E-Signature verification code has been sent to your email.';
					}
					else {
						$response['success'] = false;
						$response['message'] = 'An error occurred while sending your E-Signature verification code';
					}
				} else {
					$response['success'] = false;
					$response['message'] = 'An error occurred while setting up your E-Signature.';
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

	public function submit_token() {
		$post_data = $this->request->getPost();
		$user = $this->user->find($this->session->user_id);
		$employee = $this->employee->find($user['user_employee_id']);
		$verified = $this->verification->where([
			'ver_user_id' => $this->session->user_id,
			'ver_type' => 'e-signature',
			'ver_status' => 1
		])->first();
		if (!$employee['employee_signature'] || !$verified) {
			$response['success'] = false;
			$response['message'] = 'You must create and verify your E-Signature before creating your Security Token.';
			return $this->response->setJSON($response);
		}
		$token_data = [
			'token_symbol' => $post_data['token_symbol'],
			'token_user_id' => $this->session->user_id,
			'token_status' => 0
		];
		$token_exists = $this->token->where('token_user_id', $this->session->user_id)->first();
		if ($token_exists) {
			$token_data['token_id'] = $token_exists['token_id'];
		}
		if ($this->token->save($token_data)) {
			$response['success'] = true;
			$response['message'] = 'Please enter your password to confirm the security token.';
		} else {
			$response['success'] = false;
			$response['message'] = 'an error occurred while saving your security token.';
		}
		return $this->response->setJSON($response);
	}

	public function confirm_token() {
		$post_data = $this->request->getPost();
		$password = $post_data['password'];
		$user = $this->user->find($this->session->user_id);
		$password_verified = password_verify($password, $user['user_password']);
		if ($password_verified) {
			$token = $this->token->where('token_user_id', $this->session->user_id)->first();
			$token_data = [
				'token_id' => $token['token_id'],
				'token_status' => 1
			];
			$this->token->save($token_data);
			$response['success'] = true;
			$response['message'] = 'Your token was confirmed successfully';
		} else {
			$response['success'] = false;
			$response['message'] = 'Your token could not be confirmed as you entered your password incorrectly';
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


}
