<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Department;
use App\Models\Notice;
use App\Models\Organization;
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
		
		$this->organization = new Organization();
		$this->department = new Department();
		$this->position = new Position();
		$this->notice = new Notice();
		$this->user = new UserModel();
	}
	public function budget_setups()
	{
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['organization'] = $this->organization->first();
		return view('office/organization', $data);
		
		
	}
}
