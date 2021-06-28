<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Notice;

class NoticeController extends BaseController
{
	public function __construct()
	{
		$this->notice = new Notice();
	}

	public function index()
	{
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['notices'] = $this->notice->where('n_by', $this->session->user_id)->findAll();
		return view('notice/index', $data);
	}

	public function new_notice() {
		if ($this->request->getMethod() == 'get') {
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			return view('notice/new-notice', $data);
		}
	}
}
