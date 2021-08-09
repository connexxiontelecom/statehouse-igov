<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProjectController extends BaseController
{
    public function __construct()
    {
        if (session()->get('type') == 1): //employee
            echo view('auth/access_denied');
            exit;
        endif;
        $this->user = new UserModel();

    }
	public function index()
	{
	    $data = [
	      'firstTime'=>$this->session->firstTime,
          'username'=>$this->session->username
        ];
		return view('pages/project/index',$data);
	}

	public function showAddNewProjectForm(){
        $data = [
          'firstTime'=>$this->session->firstTime,
          'username'=>$this->session->username,
          'employees'=>$this->user->getAllUsers(),
        ];
        return view('pages/project/create',$data);
    }
}
