<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\BudgetHeader;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Notice;
use App\Models\Position;
use App\Models\UserModel;
use App\Models\BudgetLog;

class BudgetController extends BaseController
{
	
	public function __construct()
	{
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
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
		$this->brl = new BudgetLog();
	}
	
	public function budget_input()
	{
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$active_budget = $this->budget->where('budget_status', 1)->first();
			
			$data['budget'] = $active_budget;
			$data['budgets'] = $this->budget->findAll();
			$data['categories'] = $this->bc->findAll();
			$bhs = $this->bh->where('bh_budget_id', @$active_budget['budget_id'])
//				->where('bh_acc_type', 1)
				->orderBy('bh_code', 'ASC')
				->findAll();
			$new_bh = array();
			$j = 0;
			foreach ($bhs as $bh):
				$offices = json_decode($bh['bh_office']);
//				if(in_array($this->session->user_employee_id, $offices)):
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
//				endif;
			endforeach;
			
			$data['bhs'] = $new_bh;
			$data['employee_id'] = $this->session->user_employee_id;
			
		
			return view('pages/budget/budget_charts', $data);
		endif;
	}
	
	public function edit_budget_input($id){
		
		if($this->request->getMethod() == 'post'):
			
			try {
				
			
				
				$_POST['bh_amount'] = str_replace(',', '', $_POST['bh_amount']);
				
					$brl_array = array(
						'brl_employee_id' => $this->session->user_employee_id,
						'brl_bh_id' => $_POST['bh_id'],
						'brl_amount' => $_POST['bh_amount'],
						'brl_date' => date('Y-m-d H:i:s')
					);
					
					$this->brl->save($brl_array);
			
				$this->bh->save($_POST);
				
				
				session()->setFlashData("action","action successful");
//				return redirect()->back();
				return redirect()->to(base_url('/budget-input'));
			} catch (\ReflectionException $e) {
				session()->setFlashData("error",$e->getMessage());
				//return redirect()->back();
				return redirect()->to(base_url('/budget-input'));
			}
		
		endif;
		
		if($this->request->getMethod() == 'get'):
				
				$data['firstTime'] = $this->session->firstTime;
				$data['username'] = $this->session->user_username;
				$data['bhs'] = $bh = $this->bh->where('bh_id', $id)->first();
			
			$offices = json_decode($bh['bh_office']);
				if(in_array($this->session->user_employee_id, $offices) && $bh['bh_acc_type'] == 1):
				
				
				$active_budget = $this->budget->where('budget_id', $bh['bh_budget_id'])->first();
				$data['budget'] = $active_budget;
				$data['parents'] = $this->bh->where('bh_budget_id', $active_budget['budget_id'])
					->where('bh_acc_type', 0)
					->where('bh_cat', $bh['bh_cat'])
					->orderBy('bh_code', 'ASC')
					->findAll();
				
				
				$data['revisions'] = $this->brl->where('brl_bh_id', $id)
												->join('employees', 'employees.employee_id = budget_revision_logs.brl_employee_id')
												->orderBy('brl_date', 'DESC')
												->findAll();
		
				return view('pages/budget/edit_budget_chart', $data);
			else:
			
			echo "access denied";
			endif;
		endif;
	}
}
