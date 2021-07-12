<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Organization;
use App\Models\Department;
use App\Models\Position;

class GeneralSettingController extends BaseController
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
	public function organization_profile()
	{
		if($this->request->getMethod() == 'post'):
			
			$file = $this->request->getFile('file');
			if(!empty($file)):
				if($file->isValid() && !$file->hasMoved()):
					$file_name = $file->getRandomName();
					$file->move('uploads/organization', $file_name);
					$_POST['org_logo'] = $file_name;
				endif;
			endif;
			
			$this->organization->save($_POST);
			session()->setFlashData("action","action successful");
			return redirect()->to(base_url('/organization-profile'));
		
		endif;
		
		
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['organization'] = $this->organization->first();
			return view('office/organization', $data);
		endif;
	}
	
	public function departments()
	{
		if($this->request->getMethod() == 'post'):
			
			$this->department->save($_POST);
			session()->setFlashData("action","action successful");
			return redirect()->to(base_url('/departments'));
		
		endif;
		
		
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['departments'] = $this->department->findAll();
			return view('office/departments', $data);
		endif;
	}
	
	public function positions()
	{
		if($this->request->getMethod() == 'post'):
			
			$this->position->save($_POST);
			session()->setFlashData("action","action successful");
			return redirect()->to(base_url('/positions'));
		
		endif;
		
		
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['positions'] = $this->position->join('departments', 'pos_dpt_id = dpt_id')->findAll();
			$data['departments'] = $this->department->findAll();
			return view('office/positions', $data);
		endif;
	}
}
