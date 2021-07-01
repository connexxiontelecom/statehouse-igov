<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Employee;
use App\Models\Notice;
use App\Models\Post;
use App\Models\UserModel;

class PostController extends BaseController
{
	public function __construct()
	{
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
		$this->notice = new Notice();
		$this->user = new UserModel();
		$this->post = new Post();
		$this->employee = new Employee();
		
	}
	
	public function memos() {
		$search_params = @$_GET['search_params'];
		$user_id = session()->get('user_id');
		$user_data = $this->user->where('user_id', $user_id)->first();
		$employee_id = $user_data['user_employee_id'];
		$employee_data = $this->employee->where('employee_id', $employee_id)->first();
		$department_id = $employee_data['employee_department_id'];
		
		if (empty($search_params)):
			$memos = $this->post->where('p_status', 2 )
				->groupStart()
					->where('p_department_id', $department_id)
					->orWhere('p_department_id', 'a')
				->groupEnd()
				->where('p_type', 1)
				->join('users', 'posts.p_signed_by = users.user_id')
				->orderBy('p_date', 'DESC')
				->paginate(9);
		 
		else:
			if (!empty($search_params)):
				$memos = $this->post->where('p_status', 2 )
					->groupStart()
						->where('p_department_id', $department_id)
						->orWhere('p_department_id', 'a')
					->groupEnd()
					->groupStart()
						->like('p_subject', $search_params)
						->orLike('p_body', $search_params)
					->groupEnd()
					->where('p_type', 1)
					->join('users', 'posts.p_signed_by = users.user_id')
					->orderBy('p_date', 'DESC')
					->paginate(9);
			endif;
			
		endif;
		$new_memos = array();
		$i = 0;
		foreach ($memos as $memo):
			$user = $this->user->where('user_id', $memo['p_by'])->first();
			$memo['created_by'] = $user['user_name'];
			$new_memos[$i] = $memo;
			$i++;
		endforeach;
		$data['memos'] = $new_memos;
		$data['pager'] = $this->post->pager;
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		return view('/pages/posts/memos', $data);
	}
	
	public function new_memo() {
		
		if($this->request->getMethod() == 'post'):
		
		
		endif;
		
		if($this->request->getMethod() == 'get'):
			$data['signed_by'] = $this->user->where('user_status', 1)
				->groupStart()
				->where('user_type', 2)
				->orWhere('user_type', 3)
				->groupEnd()
				->findAll();
			
			$data['pager'] = $this->post->pager;
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			return view('/pages/posts/new-memo', $data);
		endif;
		$search_params = @$_GET['search_params'];
		$user_id = session()->get('user_id');
		$user_data = $this->user->where('user_id', $user_id)->first();
		$employee_id = $user_data['user_employee_id'];
		$employee_data = $this->employee->where('employee_id', $employee_id)->first();
		$department_id = $employee_data['employee_department_id'];
		
		if (empty($search_params)):
			$memos = $this->post->where('p_status', 2 )
				->groupStart()
					->where('p_department_id', $department_id)
					->orWhere('p_department_id', 'a')
				->groupEnd()
				->where('p_type', 1)
				->join('users', 'posts.p_signed_by = users.user_id')
				->orderBy('p_date', 'DESC')
				->paginate(9);
		
		else:
			if (!empty($search_params)):
				$memos = $this->post->where('p_status', 2 )
					->groupStart()
						->where('p_department_id', $department_id)
						->orWhere('p_department_id', 'a')
					->groupEnd()
					->groupStart()
						->like('p_subject', $search_params)
						->orLike('p_body', $search_params)
					->groupEnd()
					->where('p_type', 1)
					->join('users', 'posts.p_signed_by = users.user_id')
					->orderBy('p_date', 'DESC')
					->paginate(9);
			endif;
		
		endif;
		$new_memos = array();
		$i = 0;
		foreach ($memos as $memo):
			$user = $this->user->where('user_id', $memo['p_by'])->first();
			$memo['created_by'] = $user['user_name'];
			$new_memos[$i] = $memo;
			$i++;
		endforeach;
		
	}
}
