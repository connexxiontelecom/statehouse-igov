<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Department;
use App\Models\Organization;
use App\Models\Position;
use App\Models\Notice;
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
			$notices= $this->notice
				->where('n_status', 2)
				->orWhere('n_status', 3)
				->join('users', 'notices.n_signed_by = users.user_id')
				->paginate('2');
				//->findAll();
			
			$new_notices = array();
			$i = 0;
			foreach ($notices as $notice):
				$user = $this->user->where('user_id', $notice['n_by'])->first();
				$notice['created_by'] = $user['user_name'];
				$new_notices[$i] = $notice;
				$i++;
			endforeach;
			
			$data['notices'] = $notices;
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
}
