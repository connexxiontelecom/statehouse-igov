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
	
	public function meet()
	{
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		return view('pages/meeting/meet', $data);
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
			
			$appID = "970CA35de60c44645bbae8a215061b33";
			$appCertificate = "5CFd2fd1755d40ecb72977518be15d3b";
			$channelName = "7d72365eb983485397e3e3f9d460bdda";
			$uid = 2882341273;
			$uidStr = "2882341273";
			$role = RtcTokenBuilder::RoleAttendee;
			$expireTimeInSeconds = 3600;
			$currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
			$privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
			
			$token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
			echo 'Token with int uid: ' . $token . PHP_EOL;
			echo '<br>';
			$token = RtcTokenBuilder::buildTokenWithUserAccount($appID, $appCertificate, $channelName, $uidStr, $role, $privilegeExpiredTs);
			echo 'Token with user account: ' . $token . PHP_EOL;
		
		
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
