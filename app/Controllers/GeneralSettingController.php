<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Organization;
use App\Models\Department;
use App\Models\Position;
use App\Models\Registry;
use App\Models\Employee;
use App\Models\UserModel;


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
		$this->registry = new Registry();
		$this->employee = new Employee();
		$this->user = new UserModel();
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

	public function registry() {
		if ($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['registries'] = $this->_get_registries();
			$data['department_employees'] = $this->_get_department_employees();
			return view('office/registry/registries', $data);
		endif;
		$_POST['registry_status'] = 1;
		$_POST['registry_users'] = json_encode([]);
		$this->registry->save($_POST);
		session()->setFlashData("action","action successful");
		return redirect()->to(base_url('/manage-registries'));
	}

	public function new_registry() {
		if ($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['department_employees'] = $this->_get_department_employees();
			return view('office/registry/new-registry', $data);
		endif;
		if (isset($_POST['registry_users'])) {
			$_POST['registry_users'] = json_encode($_POST['registry_users']);
		}
		$this->registry->save($_POST);
		session()->setFlashData("action","create successful");
		return redirect()->to(base_url('/manage-registry')) ;
	}

	public function manage_registry($registry_id) {
		if ($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['registry'] = $this->_get_registry($registry_id);
			$data['department_employees'] = $this->_get_department_employees();
			return view('office/registry/manage-registry', $data);
		endif;
		if (isset($_POST['registry_users'])) {
			$_POST['registry_users'] = json_encode($_POST['registry_users']);
		}
		$this->registry->save($_POST);
		session()->setFlashData("action","update successful");
		return redirect()->to(base_url('/manage-registry')) ;
	}

	private function _get_registry($registry_id) {
		$registry = $this->registry->find($registry_id);
		$registry['registry_users'] = json_decode($registry['registry_users']);
		return $registry;
	}

	private function _get_department_employees() {
		$department_employees = [];
		$departments = $this->department->findAll();
		foreach ($departments as $department) {
			$department_employees[$department['dpt_name']] = [];
			$employees = $this->employee
				->where('employee_department_id', $department['dpt_id'])
				->findAll();
			foreach ($employees as $employee) {
				$user = $this->user->where('user_employee_id', $employee['employee_id'])->first();
				if ($user['user_status'] == 1 && ($user['user_type'] == 3 || $user['user_type'] == 2)) {
					$employee['user'] = $user;
					$employee['position'] = $this->position->find($employee['employee_position_id']);
					array_push($department_employees[$department['dpt_name']], $employee);
				}
			}
		}
		return $department_employees;
	}

	private function _get_registries() {
		$registries = $this->registry->findAll();
		foreach ($registries as $key => $registry) {
			$registries[$key]['manager'] = $this->user->find($registry['registry_manager_id']);
		}
		return $registries;
	}
}
