<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Department;
use App\Models\Organization;
use App\Models\Position;

class EmployeeSettingController extends BaseController
{
	public function __construct()
	{
		if (session()->get('type') == 2):
			echo view('auth/access_denieda');
			exit;
		endif;
		
		$this->organization = new Organization();
		$this->department = new Department();
		$this->position = new Position();
	}
	public function new_employee()
	{
		
		if($this->request->getMethod() == 'post'):
			
			$this->organization->save($_POST);
			session()->setFlashData("action","action successful");
			return redirect()->to(base_url('/organization-profile'));
		
		endif;
		
		
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['positions'] = $this->position->findAll();
			$data['departments'] = $this->department->findAll();
			$data['organization'] = $this->organization->first();
			return view('office/new-employee', $data);
		endif;
	}
	
	
}
