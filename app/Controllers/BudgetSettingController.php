<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\BudgetHeader;
use App\Models\Department;
use App\Models\Notice;
use App\Models\Position;
use App\Models\UserModel;
use CodeIgniter\Model;
use App\Models\Employee;

class BudgetSettingController extends BaseController
{
	public function __construct()
	{
		if (session()->get('type') == 2):
			echo view('auth/access_denieda');
			exit;
		endif;
		
		
		$this->department = new Department();
		$this->position = new Position();
		$this->notice = new Notice();
		$this->user = new UserModel();
		$this->budget = new Budget();
		$this->bh = new BudgetHeader();
		$this->bc = new BudgetCategory();
		$this->employee = new Employee();
	}
	public function budget_setups()
	{
		
		if($this->request->getMethod() == 'post'):
			$this->validator->setRules( [
				'budget_title'=>[
					'rules'=>'required',
					'errors'=>[
						'required'=>'Enter Budget Title'
					]
				],
				
				'budget_year'=>[
					'rules'=>'required',
					'errors'=>[
						'required'=>'Enter Budget Year'
					]
				]
			]);
			if ($this->validator->withRequest($this->request)->run()):
				if($_POST['budget_status'] == 1):
					$check = $this->budget->where('budget_status', 1)->first();
				
					if(!empty($check)):
						$check['budget_status'] = 0;
					$id = $check['budget_id'];
					unset($check['budget_id']);
						
						
						try {
							$this->budget->where('budget_id', $id)
								->set($check)
								->update();
						} catch (\ReflectionException $e) {
						}
					endif;
				endif;
				
				if(isset($_POST['budget_id'])):
					
					$id = $_POST['budget_id'];
					unset($_POST['budget_id']);
					
					
					try {
						$this->budget->where('budget_id', $id)
							->set($_POST)
							->update();
						session()->setFlashData("action","action successful");
						return redirect()->to(base_url('/budget-setups'));
					} catch (\ReflectionException $e) {
						session()->setFlashData("action",$e->getMessage());
						return redirect()->to(base_url('/budget-setups'));
					}
				else:
					
					try {
						$this->budget->save($_POST);
						session()->setFlashData("action","action successful");
						return redirect()->to(base_url('/budget-setups'));
					} catch (\ReflectionException $e) {
						session()->setFlashData("action",$e->getMessage());
						return redirect()->to(base_url('/budget-setups'));
					}
				endif;
				
			else:
				$arr = $this->validator->getErrors();
				session()->setFlashData("errors",$arr);
				return redirect()->to(base_url('budget-setups'));
			
			endif;
		
		endif;
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['budgets'] = $this->budget->findAll();
			return view('office/budget/budget', $data);
		endif;
		
		
	}
	
	
	public function budget_charts()
	{
		
		if($this->request->getMethod() == 'post'):
//					$this->validator->setRules( [
//						'budget_title'=>[
//							'rules'=>'required',
//							'errors'=>[
//								'required'=>'Enter Budget Title'
//							]
//						],
//
//						'budget_year'=>[
//							'rules'=>'required',
//							'errors'=>[
//								'required'=>'Enter Budget Year'
//							]
//						]
//					]);
//					if ($this->validator->withRequest($this->request)->run()):
//						if($_POST['budget_status'] == 1):
//							$check = $this->budget->where('budget_status', 1)->first();
//							$check['budget_status'] = 0;
//							$this->budget->save($check);
//						endif;
//
//						$this->budget->save($_POST);
//						session()->setFlashData("action","action successful");
//						return redirect()->to(base_url('/budget-setups'));
//					else:
//							$arr = $this->validator->getErrors();
//							session()->setFlashData("errors",$arr);
//							return redirect()->to(base_url('budget-setups'));
//
//					endif;
			
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$b_id = $_POST['bh_budget_id'];
			$active_budget = $this->budget->where('budget_id', $b_id)->first();
			$data['budget'] = $active_budget;
			$data['budgets'] = $this->budget->findAll();
			$data['categories'] = $this->bc->findAll();
			$bhs = $this->bh->where('bh_budget_id', $active_budget['budget_id'])
				->orderBy('bh_code', 'ASC')
				->findAll();
			$new_bh = array();
			$j = 0;
			foreach ($bhs as $bh):
				$offices = json_decode($bh['bh_office']);
				$office_array = array();
				$i = 0;
				foreach ($offices as $office):
					$employee = $this->employee->join('users', 'employees.employee_id = users.user_employee_id')
						->join('departments', 'employees.employee_department_id = departments.dpt_id')
						->join('positions', 'employees.employee_position_id = positions.pos_id')
						->where('employees.employee_id', $office)
						->first();
					$employee_string = $employee['dpt_name']." - ".$employee['user_name']." (".$employee['pos_name'].")".'<br>';
					$office_array[$i] = $employee_string;
					$i++;
				endforeach;
				$bh['office_d'] = $office_array;
				$new_bh[$j] = $bh;
				$j++;
			endforeach;
			
			$data['bhs'] = $new_bh;	return view('office/budget/budget_charts', $data);
		
		
		
		endif;
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$active_budget = $this->budget->where('budget_status', 1)->first();
			$data['budget'] = $active_budget;
			$data['budgets'] = $this->budget->findAll();
			$data['categories'] = $this->bc->findAll();
			$bhs = $this->bh->where('bh_budget_id', $active_budget['budget_id'])
									->orderBy('bh_code', 'ASC')
									->findAll();
			$new_bh = array();
			$j = 0;
			foreach ($bhs as $bh):
				$offices = json_decode($bh['bh_office']);
				$office_array = array();
				$i = 0;
				foreach ($offices as $office):
					$employee = $this->employee->join('users', 'employees.employee_id = users.user_employee_id')
						->join('departments', 'employees.employee_department_id = departments.dpt_id')
						->join('positions', 'employees.employee_position_id = positions.pos_id')
						->where('employees.employee_id', $office)
						->first();
					$employee_string = $employee['dpt_name']." - ".$employee['user_name']." (".$employee['pos_name'].")".'<br>';
					$office_array[$i] = $employee_string;
					$i++;
					endforeach;
					$bh['office_d'] = $office_array;
					$new_bh[$j] = $bh;
					$j++;
				endforeach;
			
			$data['bhs'] = $new_bh;
			return view('office/budget/budget_charts', $data);
		endif;
		
		
	}
	
	public function new_budget_chart(){
		
		if($this->request->getMethod() == 'post'):
			
			try {
				$_POST['bh_office'] = json_encode($_POST['bh_office']);
				$this->bh->save($_POST);
				session()->setFlashData("action","action successful");
				return redirect()->to(base_url('/new-budget-chart'));
			} catch (\ReflectionException $e) {
				session()->setFlashData("error",$e->getMessage());
				return redirect()->to(base_url('/new-budget-chart'));
			}
			
		endif;
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$active_budget = $this->budget->where('budget_status', 1)->first();
			$data['budget'] = $active_budget;
			$data['bhs'] = $this->bh->where('bh_budget_id', $active_budget['budget_id'])->findAll();
			$data['parents'] = $this->bh->where('bh_budget_id', $active_budget['budget_id'])->where('bh_acc_type', 0)->findAll();
			$data['categories'] = $this->bc->findAll();
			$data['positions'] = $this->position->findAll();
			$data['department_employees'] = $this->_get_department_employees();
			return view('office/budget/new_budget_chart', $data);
		endif;
	}
	
	public function edit_budget_chart($id){
		
		if($this->request->getMethod() == 'post'):
			
			try {
				$_POST['bh_office'] = json_encode($_POST['bh_office']);
				$this->bh->save($_POST);
				session()->setFlashData("action","action successful");
				return redirect()->back();
			} catch (\ReflectionException $e) {
				session()->setFlashData("error",$e->getMessage());
				return redirect()->back();
			}
		
		endif;
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['bhs'] = $bh = $this->bh->where('bh_id', $id)->first();
			$active_budget = $this->budget->where('budget_id', $bh['bh_budget_id'])->first();
			$data['budget'] = $active_budget;
			$data['parents'] = $this->bh->where('bh_budget_id', $active_budget['budget_id'])
									->where('bh_acc_type', 0)
									->where('bh_cat', $bh['bh_cat'])
									->findAll();
			$data['categories'] = $this->bc->findAll();
		
			$data['department_employees'] = $this->_get_department_employees();
			return view('office/budget/edit_budget_chart', $data);
		endif;
	}
	
	public function fetch_parent(){
		$category = $_POST['cat'];
		$budget_id = $_POST['b_id'];
		$parents = $this->bh->where('bh_budget_id', $budget_id)->where('bh_acc_type', 0)->where('bh_cat', $category)->findAll();
		echo json_encode($parents);
	}
	
	public  function view_budget ($budget_id) {
	
		$check_budget = $this->budget->where('budget_id', $budget_id)->first();
		if($check_budget):
			$data['budget'] = $check_budget;
			$data['budget_headers'] = $this->bh->where('bh_budget_id', $budget_id)
												->join('departments', 'budget_headers.bh_office = departments.dpt_id')
												->findAll();
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			return view('office/budget/view_budget', $data);
			
			
			else:
				
				
				
				endif;
	
	}
	
	public function budget_categories(){
		if($this->request->getMethod() == 'post'):
			
			if(isset($_POST['bc_id'])):
				
				$id = $_POST['bc_id'];
				unset($_POST['bc_id']);
				
				
				try {
					$this->bc->where('bc_id', $id)
						->set($_POST)
						->update();
					session()->setFlashData("action","action successful");
					return redirect()->to(base_url('/budget-categories'));
				} catch (\ReflectionException $e) {
					session()->setFlashData("action",$e->getMessage());
					return redirect()->to(base_url('/budget-categories'));
				}
			else:
				
				try {
					$this->bc->save($_POST);
					session()->setFlashData("action","action successful");
					return redirect()->to(base_url('/budget-categories'));
				} catch (\ReflectionException $e) {
					session()->setFlashData("action",$e->getMessage());
					return redirect()->to(base_url('/budget-categories'));
				}
			endif;
	
		
		endif;

		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['categories'] = $this->bc->findAll();
			return view('office/budget/budget-category', $data);
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
