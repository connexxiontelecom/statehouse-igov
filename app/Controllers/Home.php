<?php

namespace App\Controllers;

use App\Models\Notification;
use App\Models\Organization;

class Home extends BaseController
{
	public function __construct()
	{
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
		$this->organization = new Organization();
		$this->notification = new Notification();
	}

	public function index()
	{
		$data['username'] = $this->session->user_username;
		$data['firstTime'] = $this->session->firstTime;
		$data['organization'] = $this->organization->first();
		$data['notifications'] = [];
//		$data['organization'] = [];
		return view('pages/dashboard/index', $data);
	}

	private function _get_notifications() {
		return $this->notification->where('target_id', $this->session->user_id)->findAll();
	}
}
