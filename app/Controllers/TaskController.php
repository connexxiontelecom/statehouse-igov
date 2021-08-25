<?php

namespace App\Controllers;

use App\Models\Task;

class TaskController extends BaseController
{
  public function __construct()
  {
    if (session()->get('type') == 1):
      echo view('auth/access_denied');
      exit;
    endif;
    $this->task = new Task();
  }

	public function index()
	{
    $data['firstTime'] = $this->session->firstTime;
    $data['username'] = $this->session->user_username;
    return view('/pages/task/index', $data);
	}
}
