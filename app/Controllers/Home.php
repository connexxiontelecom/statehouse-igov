<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function __construct()
	{
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
	}
	public function index()
	{
		
		
		$data['username'] = $this->session->user_username;
		$data['firstTime'] = $this->session->firstTime;
		return view('pages/dashboard', $data);
	}
	
}
