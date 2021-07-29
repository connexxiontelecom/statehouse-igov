<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MemoController extends PostController
{
	public function memos($type = null) {
		$search_params = @$_GET['search_params'];
		$user_id = session()->get('user_id');
		$user_data = $this->user->where('user_id', $user_id)->first();
		$employee_id = $user_data['user_employee_id'];
		$employee_data = $this->employee->where('employee_id', $employee_id)->first();
		$position_id = $employee_data['employee_position_id'];
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		if (empty($search_params)) {
			$unsigned_memos = $this->_get_unsigned_memos();
			if ($unsigned_memos) session()->setFlashdata('unsigned_memos', true);
			if ($type === 'requests') {
				$data['memos'] = $unsigned_memos;
				return view('/pages/posts/memos/signature-requests', $data);
			}
			$data['memos'] = $this->_get_memos($position_id);
		} else {
			$data['memos'] = $this->_get_searched_memos($search_params, $position_id);
		}
		$data['pager'] = $this->post->pager;
		return view('/pages/posts/memos/index', $data);
	}

	public function internal_memo() {
		if($this->request->getMethod() == 'get'):
			$data['signed_by'] = $this->user->where('user_status', 1)
				->groupStart()
				->where('user_type', 2)
				->orWhere('user_type', 3)
				->groupEnd()
				->findAll();
			$data['positions'] = $this->position->findAll();
			$data['pager'] = $this->post->pager;
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			return view('/pages/posts/memos/new-internal-memo', $data);
		endif;
		$post_data = $this->request->getPost();
		$memo_data = [
			'p_ref_no' => $post_data['p_ref_no'],
			'p_subject' => $post_data['p_subject'],
			'p_type' => 1,
			'p_body' => $post_data['p_body'],
			'p_status' => 0,
			'p_by' => $this->session->user_id,
			'p_signed_by' => $post_data['p_signed_by'],
			'p_direction' => 1,
			'p_recipients_id' => json_encode($post_data['positions'])
		];
		$post_id = $this->post->insert($memo_data);
		$attachments = $post_data['p_attachment'];
		if ($post_id) {
			$this->_upload_attachments($attachments, $post_id);
			$response['success'] = true;
			$response['message'] = 'Successfully created the internal memo';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while creating the internal memo';
		}
		return $this->response->setJSON($response);
	}

	public function external_memo(){
		if($this->request->getMethod() == 'get'):
			$data['signed_by'] = $this->user->where('user_status', 1)
				->groupStart()
				->where('user_type', 2)
				->orWhere('user_type', 3)
				->groupEnd()
				->findAll();
			$data['positions'] = $this->position->findAll();
			$data['pager'] = $this->post->pager;
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			return view('/pages/posts/memos/new-external-memo', $data);
		endif;
		$post_data = $this->request->getPost();
		$memo_data = [
			'p_ref_no' => $post_data['p_ref_no'],
			'p_subject' => $post_data['p_subject'],
			'p_type' => 1,
			'p_body' => $post_data['p_body'],
			'p_status' => 0,
			'p_by' => $this->session->user_id,
			'p_signed_by' => $post_data['p_signed_by'],
			'p_direction' => 2,
			'p_recipients_id' => json_encode($post_data['positions'])
		];
		$post_id = $this->post->insert($memo_data);
		$attachments = $post_data['p_attachment'];
		if ($post_id) {
			$this->_upload_attachments($attachments, $post_id);
			$response['success'] = true;
			$response['message'] = 'Successfully created the external memo';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while creating the external memo';
		}
		return $this->response->setJSON($response);
	}

	public function my_memos() {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['memos'] = $this->_get_user_memos();
		return view('/pages/posts/memos/my-memos', $data);
	}

	public function view_memo($memo_id) {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['memo'] = $this->_get_memo($memo_id);
		return view('/pages/posts/memos/view-memo', $data);
	}

	public function edit_memo($memo_id = null) {
		if ($this->request->getMethod() == 'get') {
			$data['signed_by'] = $this->user->where('user_status', 1)
				->groupStart()
				->where('user_type', 2)
				->orWhere('user_type', 3)
				->groupEnd()
				->findAll();
			$data['positions'] = $this->position->findAll();
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['memo'] = $this->_get_memo($memo_id);
			return view('/pages/posts/memos/edit-internal-memo', $data);
		}
		$post_data = $this->request->getPost();
		$memo_data = [
			'p_id' => $post_data['memo_id'],
			'p_ref_no' => $post_data['p_ref_no'],
			'p_subject' => $post_data['p_subject'],
			'p_body' => $post_data['p_body'],
			'p_signed_by' => $post_data['p_signed_by'],
			'p_recipients_id' => json_encode($post_data['positions'])
		];
		if ($this->post->save($memo_data)) {
			$response['success'] = true;
			$response['message'] = 'Successfully edited the memo';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while editing the memo';
		}
		return $this->response->setJSON($response);
	}

	private function _get_memos($position_id) {
		$memos = $this->post
			->where('p_status', 2)
			->where('p_type', 1)
			->orderBy('p_date', 'DESC')
			->paginate(9);
		$new_memos = [];
		foreach ($memos as $memo) {
			$recipient_ids = json_decode($memo['p_recipients_id']);
			$recipients = [];
			foreach ($recipient_ids as $recipient_id) {
				array_push($recipients, $this->position->find($recipient_id));
			}
			if (in_array($position_id, $recipient_ids) || $memo['p_signed_by'] == session()->user_id || $memo['p_by'] == session()->user_id) {
				$memo['written_by'] = $this->user->find($memo['p_by']);
				$memo['signed_by'] = $this->user->find($memo['p_signed_by']);
				$memo['recipients'] = $recipients;
				array_push($new_memos, $memo);
			}
		}
		return $new_memos;
	}

	private function _get_unsigned_memos() {
		$memos = $this->post
			->where('p_signed_by', $this->session->user_id)
			->where('p_type', 1)
			->where('p_status', 0)
			->orderBy('p_date', 'DESC')
			->findAll();
		foreach ($memos as $key => $memo) {
			$recipient_ids = json_decode($memo['p_recipients_id']);
			$recipients = [];
			foreach ($recipient_ids as $recipient_id) {
				array_push($recipients, $this->position->find($recipient_id));
			}
			$memos[$key]['written_by'] = $this->user->find($memo['p_by']);
			$memos[$key]['recipients'] = $recipients;
		}
		return $memos;
	}

	private function _get_searched_memos($search_params, $position_id) {
		$memos = $this->post
			->where('p_status', 2)
			->where('p_type', 1)
			->like('p_subject', $search_params)
			->orderBy('p_date', 'DESC')
			->paginate(9);
		$searched_memos = [];
		foreach ($memos as $memo) {
			$recipient_ids = json_decode($memo['p_recipients_id']);
			$recipients = [];
			foreach ($recipient_ids as $recipient_id) {
				array_push($recipients, $this->position->find($recipient_id));
			}
			if (in_array($position_id, $recipient_ids)) {
				$memo['written_by'] = $this->user->find($memo['p_by']);
				$memo['signed_by'] = $this->user->find($memo['p_signed_by']);
				$memo['recipients'] = $recipients;
				array_push($searched_memos, $memo);
			}
		}
		return $searched_memos;
	}

	private function _get_user_memos() {
		$memos = $this->post
			->where('p_by', $this->session->user_id)
			->where('p_type', 1)
			->orderBy('p_date', 'DESC')
			->findAll();
		foreach ($memos as $key => $memo) {
			$memos[$key]['signed_by'] = $this->user->find($memo['p_signed_by']);
		}
		return $memos;
	}

	private function _get_memo($memo_id) {
		$memo = $this->post->find($memo_id);
		if ($memo) {
			$memo['written_by'] = $this->user->find($memo['p_by']);
			$memo['signed_by'] = $this->user->find($memo['p_signed_by']);
			$memo['attachments'] = $this->pa->where('pa_post_id', $memo_id)->findAll();
			$recipient_ids = json_decode($memo['p_recipients_id']);
			$recipients = [];
			foreach ($recipient_ids as $recipient_id) {
				array_push($recipients, $this->position->find($recipient_id));
			}
			$memo['recipients'] = $recipients;
			$memo['organization'] = $this->organization->first();
		}
		return $memo;
	}
}
