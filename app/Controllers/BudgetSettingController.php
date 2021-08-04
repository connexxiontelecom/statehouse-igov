<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Budget;
use App\Models\BudgetHeader;
use App\Models\Department;
use App\Models\Notice;
use App\Models\Position;
use App\Models\UserModel;
use CodeIgniter\Model;

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
	}
	public function budget_setups()
	{
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['budgets'] = $this->budget->findAll();
		return view('office/budget/budget', $data);
		
		
	}
	
	
	public function budget_setup()
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
				$budget = array();
				$budget['budget_title'] = $_POST['budget_title'];
				$budget['budget_year'] = $_POST['budget_year'];
				
				$bh_title = $_POST['bh_title'];
				$bh_office = $_POST['bh_office'];
				$bh_amount = $_POST['bh_amount'];
				
				$budget_id = $this->budget->insert($budget);
				
				
				if($budget_id):
				
				if(count($bh_title)):
					$k = 0;
						for($n = 0; $n<count($bh_title); $n++):
							
							$bh_array = array(
								'bh_title' => $bh_title[$n],
								'bh_office' => $bh_office[$n],
								'bh_amount'=> $bh_amount[$n],
								'bh_budget_id' => $budget_id
							);
						
						$check = $this->bh->save($bh_array);
						if(!$check):
							$this->budget->where('budget_id', $budget_id)->delete();
							$this->bh->where('bh_budget_id', $budget_id)->delete();
							$arr = array('An error Occurred while creating budget headers');
							session()->setFlashData("errors",$arr);
							return redirect()->to(base_url('budget-setup'));
						endif;
						$k++;
					endfor;
					
					if($k):
						
						session()->setFlashData("action",'Action Successful');
						return redirect()->to(base_url('budget-setups'));
					else:
						
						$arr = array('An error occurred');
						session()->setFlashData("errors",$arr);
						return redirect()->to(base_url('budget-setup'));
					endif;
				
				else:
					$this->budget->where('budget_id', $budget_id)->delete();
					
					$arr = array('No Budget Headers Sent');
					session()->setFlashData("errors",$arr);
					return redirect()->to(base_url('budget-setup'));
					endif;
					
					
					else:
						
						
						$arr = array('An error occurred while creating the budget');
						session()->setFlashData("errors",$arr);
						return redirect()->to(base_url('budget-setup'));
				endif;
				
				
			else:
					$arr = $this->validator->getErrors();
					session()->setFlashData("errors",$arr);
					return redirect()->to(base_url('budget-setup'));
				
				endif;
		
		endif;
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['departments'] = $this->department->findAll();
			return view('office/budget/budget_setup', $data);
		endif;
		
		
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
}
