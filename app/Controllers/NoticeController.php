<?php

namespace App\Controllers;


class NoticeController extends PostController
{
	public function index($type = null) {
		$search_params = @$_GET['search_params'];
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		if (empty($search_params)) {
			$unsigned_notices = $this->_get_unsigned_notices();
			if ($unsigned_notices) session()->setFlashdata('unsigned_notices', true);
			if ($type === 'requests') {
				$data['notices'] = $unsigned_notices;
				return view('/pages/posts/notices/signature-requests', $data);
			}
			$data['notices'] = $this->_get_notices();
		} else {
			$data['notices'] = $this->_get_searched_notices($search_params);
		}
		$data['pager'] = $this->post->pager;
		return view('/pages/posts/notices/index', $data);
	}

	public function my_notices() {
		$data['notices'] = $this->_get_user_notices();
		$data['pager'] = $this->notice->pager;
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		return view('/pages/posts/notices/my-notices', $data);
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
			return view('/pages/posts/notices/new-notice', $data);
		}
		$post_data = $this->request->getPost();
		$notice_data = [
			'p_ref_no' => $post_data['p_ref_no'],
			'p_subject' => $post_data['p_subject'],
			'p_type' => 3,
			'p_body' => $post_data['p_body'],
			'p_status' => 0,
			'p_by' => $this->session->user_id,
			'p_signed_by' => $post_data['p_signed_by'],
			'p_direction' => 1
		];
		$post_id = $this->post->insert($notice_data);
		$attachments = $post_data['p_attachment'];
		if ($post_id) {
			$this->_upload_attachments($attachments, $post_id);
			$response['success'] = true;
			$response['message'] = 'Successfully created the notice';
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
			$data['signed_by'] = $this->user->where('user_status', 1)
				->groupStart()
				->where('user_type', 2)
				->orWhere('user_type', 3)
				->groupEnd()
				->findAll();
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
		$notices = $this->post
			->where('p_status', 2)
			->where('p_type', 3)
			->orderBy('p_date', 'DESC')
			->paginate(9);
		foreach($notices as $key => $notice) {
			$written_by = $this->user->find($notice['p_by']);
			$signed_by = $this->user->find($notice['p_signed_by']);
			$notices[$key]['written_by'] = $written_by;
			$notices[$key]['signed_by'] = $signed_by;
		}
		return $notices;
	}

	private function _get_user_notices() {
		$notices = $this->post
			->where('p_by', $this->session->user_id)
			->where('p_type', 3)
			->orderBy('p_date', 'DESC')
			->findAll();
		foreach($notices as $key => $notice) {
			$signed_by = $this->user->find($notice['p_signed_by']);
			$notices[$key]['signed_by'] = $signed_by;
		}
		return $notices;
	}

	private function _get_searched_notices($search_params) {
		$notices = $this->post
			->where('p_status', 2)
			->where('p_type', 3)
			->like('p_subject', $search_params)
			->orderBy('p_date', 'DESC')
			->paginate(9);
		foreach($notices as $key => $notice) {
			$written_by = $this->user->find($notice['p_by']);
			$signed_by = $this->user->find($notice['p_signed_by']);
			$notices[$key]['written_by'] = $written_by;
			$notices[$key]['signed_by'] = $signed_by;
		}
		return $notices;
	}

	private function _get_unsigned_notices() {
		$notices = $this->post
			->where('p_signed_by', $this->session->user_id)
			->where('p_type', 3)
			->where('p_status', 0)
			->orderBy('p_date', 'DESC')
			->findAll();
		foreach($notices as $key => $notice) {
			$written_by = $this->user->find($notice['p_by']);
			$signed_by = $this->user->find($notice['p_signed_by']);
			$notices[$key]['written_by'] = $written_by;
			$notices[$key]['signed_by'] = $signed_by;
		}
		return $notices;
	}

}
