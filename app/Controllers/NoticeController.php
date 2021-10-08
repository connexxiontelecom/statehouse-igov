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
      $data['department_employees'] = $this->_get_department_employees();
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
			$this->send_notification('New Notice Created', 'You created a new notice', $this->session->user_id, site_url('view-notice/').$post_id, 'click to view notice');
			$this->send_notification('New Notice Created', 'A notice was created. You are the signatory.', $post_data['p_signed_by'], site_url('view-notice/').$post_id, 'click to view notice');
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
			$data['notice'] = $this->_get_notice($notice_id);
			return view('/pages/posts/notices/edit-notice', $data);
		}
		$post_data = $this->request->getPost();
		$notice_data = [
			'p_id' => $post_data['notice_id'],
			'p_ref_no' => $post_data['p_ref_no'],
			'p_subject' => $post_data['p_subject'],
			'p_body' => $post_data['p_body'],
			'p_signed_by' => $post_data['p_signed_by']
		];
		if ($this->post->save($notice_data)) {
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
		return view('/pages/posts/notices/view-notice', $data);
	}

	private function _get_notice($notice_id) {
		$notice = $this->post->find($notice_id);
		if ($notice) {
			$notice['written_by'] = $this->user->find($notice['p_by']);
			$notice['signed_by'] = $this->user->find($notice['p_signed_by']);
			$notice['attachments'] = $this->pa->where('pa_post_id', $notice_id)->findAll();
			$notice['organization'] = $this->organization->first();
		}
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

  private function _get_department_employees() {
    $department_employees = [];
    $departments = $this->department->findAll();
    foreach ($departments as $department) {
      $department_employees[$department['dpt_name']] = [];
      $employees = $this->employee
        ->where('employee_department_id', $department['dpt_id'])
        ->findAll();
      foreach ($employees as $employee) {
        $user = $this->user->where('user_employee_id', $employee['employee_id'])->first();
        if ($user['user_status'] == 1 && ($user['user_type'] == 3 || $user['user_type'] == 2)) {
          $employee['user'] = $user;
          $employee['position'] = $this->position->find($employee['employee_position_id']);
          array_push($department_employees[$department['dpt_name']], $employee);
        }
      }
    }
    return $department_employees;
  }

}
