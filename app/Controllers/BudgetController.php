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
	}
	
	public function index()
	{
		//
	}
}
