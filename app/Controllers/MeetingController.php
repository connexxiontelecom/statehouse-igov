<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Agora\RtcTokenBuilder;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\UserModel;
use DateTime;
use DateTimeZone;
use App\Models\Meeting;
use CodeIgniter\I18n\Time;
//use RtcTokenBuilder;

class MeetingController extends BaseController
{

	
	public function __construct()
	{
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
		$this->meeting = new Meeting();
		$this->department = new Department();
		$this->employee = new Employee();
		$this->user = new UserModel();
		$this->position = new Position();

	}
	
	
	
	public function meetings(){
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		
		$meetings = $this->meeting->findAll();
		
		$meeting_array = array();
		$i = 0;
		foreach ($meetings as $meeting):
			
			$employees = json_decode($meeting['meeting_employees']);
				if(in_array($this->session->user_employee_id, $employees)):
					$meeting_array[$i] = $meeting;
					$i++;
				endif;
		
			endforeach;
		$data['meetings'] = $meeting_array;
		return view('pages/meeting/meetings', $data);
	}
	
	public function join_meeting($meeting_id, $token){
		
		$length = strlen($token);
		$token = substr($token, 0, $length);
		$meeting = $this->meeting->where('meeting_id', $meeting_id)->first();
		
	
			if(!empty($meeting)):
//				echo $token;
//
//				echo '<br>';
//				echo '<br>';
//				echo substr($meeting['meeting_token'], 0, strlen($token));
				if(1):
						$employees = json_decode($meeting['meeting_employees']);
						if(in_array($this->session->user_employee_id, $employees)):

							$data['firstTime'] = $this->session->firstTime;
							$data['username'] = $this->session->user_username;
							$data['user_name'] = $this->session->user_name;
							$data['token'] = $meeting['meeting_token'];
							$data['app_id'] = "614ab02fa02f4e91ac65d20752251650";
							$data['channel'] = $meeting['meeting_name_strip'];
							return view('pages/meeting/join-meeting', $data);

						else:
							throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
						endif;
					else:
						throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

					endif;

			else:

					throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			endif;

	
	
	}
	
	public function meet()
	{
//		$data['firstTime'] = $this->session->firstTime;
//		$data['username'] = $this->session->user_username;
//		return view('pages/meeting/meet', $data);
//
//		$dt   = new DateTime('2021-09-10 00:00');
//		try {
//			$time = Time::createFromInstance($dt, 'en_US');
//			echo $time;
//		} catch (\Exception $e) {
//			print_r($e);
//		}
		
	
	}
	
	/**
	 * @throws \Exception
	 */
	public function new_meeting(){
		
		if($this->request->getMethod() == 'get'):
			
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['department_employees'] = $this->_get_department_employees();
			return view('pages/meeting/new-meeting', $data);
			
		
		endif;
		
		if($this->request->getMethod() == 'post'):
			
			$_POST['meeting_name_strip'] = preg_replace('/\s/','',$_POST['meeting_name']);
			$start_time = new DateTime($_POST['meeting_start']);
			$start_time = Time::createFromInstance($start_time);
		
		if(strtotime($start_time) > time()):
			$end_time = new DateTime($_POST['meeting_end']);
			$end_time = Time::createFromInstance($end_time);
			
			$diff = $start_time->difference($end_time);
		
			$seconds =  $diff->getSeconds();

			if($seconds < 1):
				$response['success'] = false;
				$response['message'] = 'Meeting Start Time Greater Than End Time';
				
				else:
					$appID = "614ab02fa02f4e91ac65d20752251650";
					$appCertificate = "99a82063baac42629a76347d81bdfd45";
					$channelName = $_POST['meeting_name_strip'];
					//$uid = 2882341273;
					$uid = 0;
					//$uidStr = "2882341273";
					$role = RtcTokenBuilder::RolePublisher;
//					$expireTimeInSeconds = 3600;
//					$currentTimestamp =  $time->addSeconds(23)->getTimestamp();
					//$privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
					$privilegeExpiredTs =  strtotime($end_time);

					$token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
//			echo '<br>';
//			$token = RtcTokenBuilder::buildTokenWithUserAccount($appID, $appCertificate, $channelName, $uidStr, $role, $privilegeExpiredTs);
//			echo 'Token with user account: ' . $token . PHP_EOL;
					$meeting_array = array(
					'meeting_employees' => json_encode($_POST['meeting_employees']),
					'meeting_token' => $token,
					'meeting_name' => $_POST['meeting_name'],
					'meeting_name_strip' => $_POST['meeting_name_strip'],
					'meeting_start' => $start_time,
					'meeting_end' => $end_time
					);
					
					try {
						$meeting_id = $this->meeting->insert($meeting_array);
						$this->send_notification('New Meeting Created', 'You created a new meeting', $this->session->user_id, site_url('/join-meeting/').$meeting_id.'/'.$token, 'click to join meeting');
						$employee_ids = $_POST['meeting_employees'];
						foreach($employee_ids as $employee_id) {
							$user = $this->user->where('user_employee_id', $employee_id)->find();
							$this->send_notification('New Meeting Created', 'You were selected as a participant in a new meeting', $user['user_id'], site_url('/join-meeting/').$meeting_id.'/'.$token, 'click to join meeting');
						}
						$response['success'] = true;
						$response['message'] = 'Successfully scheduled a meeting';
						
					}catch (\Exception $e){
						$response['success'] = false;
						$response['message'] = 'Meeting Start Time Greater Than End Time';
					}

					endif;
		
		else:
			
			$response['success'] = false;
			$response['message'] = 'Meeting cannot start before now';
		
		
		endif;
			
			
			return $this->response->setJSON($response);
		
		endif;
		
		
	}
	
	private function _get_department_employees() {
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
}
