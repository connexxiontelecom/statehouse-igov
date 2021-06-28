<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Notice;
use App\Models\UserModel;

class NoticeController extends BaseController
{
	public function __construct()
	{
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
		$this->notice = new Notice();
		$this->user = new UserModel();
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

	public function new_notice() {
		if ($this->request->getMethod() == 'get') {
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['signed_by'] = $this->user->findAll();
			return view('/pages/notice/new-notice', $data);
		}
		$post_data = $this->request->getPost();
		$notice_data = [
			'n_subject' => $post_data['subject'],
			'n_body' => $post_data['body'],
			'n_status' => 0,
			'n_by' => $this->session->user_id,
			'n_signed_by' => $post_data['signed_by']
		];
		if ($this->notice->save($notice_data)) {
			session()->setFlashdata('success', 'Successfully created the notice!');
		} else {
			session()->setFlashdata('error', 'Sorry, there was an error while creating the notice!');
		}
		return redirect()->to(base_url('/notices'));
	}

	private function _get_notices() {
		$notices = $this->notice
			->where('n_by', $this->session->user_id)
			->orderBy('created_at', 'DESC')
			->paginate('9');
		foreach($notices as $key => $notice) {
			$signed_by = $this->user->find($notice['n_signed_by']);
			$notices[$key]['signed_by'] = $signed_by;
		}
		return $notices;
	}

	private function _get_searched_notices($search_params) {
		$notices = $this->notice
			->where('n_by', $this->session->user_id)
			->groupStart()
				->like('n_subject', $search_params)
				->orLike('n_body', $search_params)
			->groupEnd()
			->orderBy('created_at', 'DESC')
			->paginate('9');
		foreach($notices as $key => $notice) {
			$signed_by = $this->user->find($notice['n_signed_by']);
			$notices[$key]['signed_by'] = $signed_by;
		}
		return $notices;
	}

}
