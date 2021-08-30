<?php

namespace App\Controllers;

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
	}
	public function index()
	{
		$data['username'] = $this->session->user_username;
		$data['firstTime'] = $this->session->firstTime;
		$data['organization'] = $this->organization->first();
		return view('pages/dashboard/index', $data);
	}
	
}
