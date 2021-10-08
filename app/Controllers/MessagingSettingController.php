<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Department;
use App\Models\Organization;
use App\Models\Position;
use App\Models\Notice;
use App\Models\Stamp;
use App\Models\UserModel;

class MessagingSettingController extends BaseController
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
		$this->notice = new Notice();
		$this->user = new UserModel();
		$this->stamp = new Stamp();
		$this->employee = new Employee();

	}
	public function notice_board()
	{
		if($this->request->getMethod() == 'post'):
				$this->notice->save($_POST);
				session()->setFlashData("action","action successful");
				return redirect()->to(base_url('/notice-board'));
			
		
		endif;
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$search_params = @$_GET['search_params'];
			$filter_params = @$_GET['filter_params'];
			
			if(empty($search_params) && empty($filter_params)):
				$notices= $this->notice
					->where('n_status', 2)
					->orWhere('n_status', 3)
					->join('users', 'notices.n_signed_by = users.user_id')
					->orderBy('notices.created_at', 'DESC')
					->paginate('9');
			
			else:
				if($search_params):
					$notices= $this->notice
						->groupStart()
							->where('n_status', 2)
							->orWhere('n_status', 3)
						->groupEnd()
						->groupStart()
							->like('n_subject', $search_params)
							->orLike('n_body', $search_params)
						->groupEnd()
						->join('users', 'notices.n_signed_by = users.user_id')
						->orderBy('notices.created_at', 'DESC')
						->paginate('9');
				endif;
				
				if($filter_params):
					
						switch ($filter_params):
							case 'a':
								$notices= $this->notice
									->where('n_status', 2)
									->orWhere('n_status', 3)
									->join('users', 'notices.n_signed_by = users.user_id')
									->orderBy('notices.created_at', 'DESC')
									->paginate('9');
								break;
							case 2:
								$notices= $this->notice
									->where('n_status', 2)
									->join('users', 'notices.n_signed_by = users.user_id')
									->orderBy('notices.created_at', 'DESC')
									->paginate('9');
								break;
							case 3:
								$notices= $this->notice
									->where('n_status', 3)
									->join('users', 'notices.n_signed_by = users.user_id')
									->orderBy('notices.created_at', 'DESC')
									->paginate('9');
								break;
							default:
								$notices= $this->notice
								->where('n_status', 2)
								->orWhere('n_status', 3)
								->join('users', 'notices.n_signed_by = users.user_id')
								->orderBy('notices.created_at', 'DESC')
								->paginate('9');
						endswitch;
					
					endif;
			
		
			endif;
			$new_notices = array();
			$i = 0;
			foreach ($notices as $notice):
				$user = $this->user->where('user_id', $notice['n_by'])->first();
				$notice['created_by'] = $user['user_name'];
				$new_notices[$i] = $notice;
				$i++;
			endforeach;
			$data['notices'] = $new_notices;
			$data['pager'] = $this->notice->pager;
			return view('office/notice_board', $data);
			
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

	public function stamp() {
		if ($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['department_employees'] = $this->_get_department_employees();
			return view('office/stamp/stamps', $data);
		endif;
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
}
