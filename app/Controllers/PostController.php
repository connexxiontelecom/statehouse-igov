<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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
	}
	
	public function index() {
		$search_params = @$_GET['search_params'];
		if (empty($search_params)) {
			$data['notices'] = $this->_get_notices();
		} else {
			if (!empty($search_params)) {
				$data['notices'] = $this->_get_searched_notices($search_params);
			}
		}
		$data['pager'] = $this->notice->pager;
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		return view('/pages/notice/index', $data);
	}
}
