<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CentralRegistry extends BaseController
{
	public function __construct() {
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
	}

	public function index() {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		return view('/pages/central-registry/index', $data);
	}
}
