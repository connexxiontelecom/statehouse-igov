<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MemoController extends BaseController
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
		//
	}
}
