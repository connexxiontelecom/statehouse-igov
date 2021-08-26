<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Agora\RtcTokenBuilder;
use DateTime;
use DateTimeZone;
//use RtcTokenBuilder;

class MeetingController extends BaseController
{

	
	public function __construct()
	{
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;

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
		
		$token = RtcTokenBuilder::buildTokenWithUserAccount($appID, $appCertificate, $channelName, $uidStr, $role, $privilegeExpiredTs);
		echo 'Token with user account: ' . $token . PHP_EOL;
	}
}
