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

	public function user_notices() {
		$data['notices'] = $this->_get_user_notices();
		$data['pager'] = $this->notice->pager;
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		return view('/pages/notice/my-notices', $data);
	}

	public function new_notice() {
		if ($this->request->getMethod() == 'get') {
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['signed_by'] = $this->user->where('user_status', 1)
											->groupStart()
												->where('user_type', 2)
												->orWhere('user_type', 3)
											->groupEnd()
											->findAll();
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
			$response['success'] = true;
			$response['message'] = 'Successfully created notice';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while creating notice';
		}
		return $this->response->setJSON($response);
	}

	public function edit_notice($notice_id = null) {
		if ($this->request->getMethod() == 'get') {
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['signed_by'] = $this->user->findAll();
			$data['notice'] = $this->notice->find($notice_id);
			return view('/pages/notice/edit-notice', $data);
		}
		$post_data = $this->request->getPost();
		$notice_data = [
			'n_id' => $post_data['n_id'],
			'n_subject' => $post_data['subject'],
			'n_body' => $post_data['body'],
			'n_signed_by' => $post_data['signed_by']
		];
		if ($this->notice->save($notice_data)) {
			$response['success'] = true;
			$response['message'] = 'Successfully edited notice';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while editing notice';
		}
		return $this->response->setJSON($response);
	}

	public function view_notice($notice_id) {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['notice'] = $this->_get_notice($notice_id);
		return view('/pages/notice/view-notice', $data);
	}

	private function _get_notice($notice_id) {
		$notice = $this->notice->find($notice_id);
		$notice['signed_by'] = $this->user->find($notice['n_signed_by']);
		return $notice;
	}
	private function _get_notices() {
		$notices = $this->notice
			->where('n_status', 2)
			->orderBy('created_at', 'DESC')
			->paginate('9');
		foreach($notices as $key => $notice) {
			$signed_by = $this->user->find($notice['n_signed_by']);
			$notices[$key]['signed_by'] = $signed_by;
		}
		return $notices;
	}

	private function _get_user_notices() {
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
			->where('n_status', 2)
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
