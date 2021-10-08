<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CircularController extends PostController
{
	public function circulars($type = null) {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$search_params = @$_GET['search_params'];
		$l_user = $this->user->where('user_username', $this->session->user_username)
			->join('employees', 'users.user_employee_id = employees.employee_id')
			->first();
		$department_id = $l_user['employee_department_id'];
		if (empty($search_params)):
			$unsigned_circulars = $this->_get_unsigned_circulars();
			if ($unsigned_circulars) session()->setFlashdata('unsigned_circulars', true);
			if ($type === 'requests'):
				$data['circulars'] = $unsigned_circulars;
				return view('/pages/posts/circulars/signature-requests', $data);
			endif;
			$circulars = array();
			$posts = $this->post
				->where('p_type', 2)
				->where('p_status', 2)
				->join('users', 'posts.p_signed_by = users.user_id')
				->orderBy('posts.p_date', 'DESC')
				->paginate(9);
			$i = 0;
			foreach ($posts as $post):
				$posts_dpts = json_decode($post['p_recipients_id']);
				$recipients = [];
				foreach($posts_dpts as $posts_dpt):
					array_push($recipients, $this->department->find($posts_dpt));
				endforeach;
				if(in_array($department_id, $posts_dpts) || $post['p_by'] == session()->user_id || $post['p_signed_by'] == session()->user_id):
					$user = $this->user->find($post['p_by']);
					$post['created_by'] = $user['user_name'];
					$post['recipients'] = $recipients;
					$circulars[$i] = $post;
					$i++;
				endif;
			endforeach;
			$data['circulars'] = $circulars;
		else:
			$data['circulars'] = $this->_get_searched_circulars($search_params, $department_id);
		endif;
		$data['pager'] = $this->post->pager;
		return view('/pages/posts/circulars/circulars', $data);
	}

	public function new_circular() {
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;

			return view('/pages/posts/circulars/new-circular', $data);

		endif;
	}

	public function internal_circular() {
		if($this->request->getMethod() == 'get'):
      $data['department_employees'] = $this->_get_department_employees();
      $data['departments']= $this->department->findAll();
			$data['pager'] = $this->post->pager;
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			return view('/pages/posts/circulars/new-internal-circular', $data);
		endif;
		if($this->request->getMethod() == 'post'):
			$p_attachments = array();
			if(isset($_POST['p_attachment'])):
				$p_attachments = $_POST['p_attachment'];
				unset($_POST['p_attachment']);
			endif;
			$_POST['p_by'] = $this->session->user_id;
			$_POST['p_direction'] = 1;
			$_POST['p_status'] = 0;
			$_POST['p_type'] = 2;
			if(isset($_POST['all_department'])):
				unset($_POST['all_department']);
				$departments = $this->department->findAll();
				$new_dpt = array();
				$i = 0;
				foreach ($departments as $department):
					$new_dpt[$i] = $department['dpt_id'];
					$i++;
				endforeach;
				$_POST['p_recipients_id'] = json_encode($new_dpt);
			else:
				$_POST['p_recipients_id'] = json_encode($_POST['p_recipients_id']);
			endif;
			$p_id = $this->post->insert($_POST);
			if ($p_id):
				$this->_upload_attachments($p_attachments, $p_id);
				$this->send_notification('New Internal Circular Created', 'You created a new internal circular', $this->session->user_id, site_url('view-circular/').$p_id, 'click to view circular');
				$this->send_notification('New Internal Circular Created', 'An internal circular was created. You are the signatory.', $_POST['p_signed_by'], site_url('view-circular/').$p_id, 'click to view circular');
				$response['success'] = true;
				$response['message'] = 'Successfully created the internal circular';
			else:
				$response['success'] = false;
				$response['message'] = 'There was an error while creating the internal circular';
			endif;
			return $this->response->setJSON($response);
		endif;
	}

  public function external_circular(){
    if($this->request->getMethod() == 'get'):
      $data['department_employees'] = $this->_get_department_employees();
      $data['departments']= $this->department->findAll();
      $data['pager'] = $this->post->pager;
      $data['firstTime'] = $this->session->firstTime;
      $data['username'] = $this->session->user_username;
      return view('/pages/posts/circulars/new-external-circular', $data);
    endif;
    $p_attachments = array();
    if(isset($_POST['p_attachment'])):
      $p_attachments = $_POST['p_attachment'];
      unset($_POST['p_attachment']);
    endif;
    $_POST['p_by'] = $this->session->user_id;
    $_POST['p_direction'] = 2;
    $_POST['p_status'] = 0;
    $_POST['p_type'] = 2;
    $p_id = $this->post->insert($_POST);
    if ($p_id):
      $this->_upload_attachments($p_attachments, $p_id);
	    $this->send_notification('New External Circular Created', 'You created a new external circular', $this->session->user_id, site_url('view-circular/').$p_id, 'click to view circular');
	    $this->send_notification('New External Circular Created', 'An external circular was created. You are the signatory.', $_POST['p_signed_by'], site_url('view-circular/').$p_id, 'click to view circular');
	    $response['success'] = true;
      $response['message'] = 'Successfully created the external circular';
    else:
      $response['success'] = false;
      $response['message'] = 'There was an error while creating the external circular';
    endif;
    return $this->response->setJSON($response);
  }

	public function view_circular($p_id){
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['circular'] = $this->_get_circular($p_id);
		return view('/pages/posts/circulars/view-circular', $data);
	}


	public function my_circulars(){
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['circulars'] = $this->_get_user_circulars();
		return view('/pages/posts/circulars/my-circulars', $data);
	}

	private function _get_searched_circulars($search_params, $department_id) {
		$circulars = $this->post
			->where('p_status', 2)
			->where('p_type', 2)
			->join('users', 'posts.p_signed_by = users.user_id')
			->like('p_subject', $search_params)
			->orderBy('p_date', 'DESC')
			->paginate(9);
		$searched_circulars = [];
		foreach ($circulars as $circular) {
			$recipient_ids = json_decode($circular['p_recipients_id']);
			$recipients = [];
			foreach ($recipient_ids as $recipient_id) {
				array_push($recipients, $this->department->find($recipient_id));
			}
			if (in_array($department_id, $recipient_ids)) {
				$created_by = $this->user->find($circular['p_by']);
				$circular['created_by'] = $created_by['user_name'];
				$circular['recipients'] = $recipients;
				array_push($searched_circulars, $circular);
			}
			return $searched_circulars;
		}
	}

	private function _get_unsigned_circulars() {
		$circulars = $this->post
			->where('p_signed_by', $this->session->user_id)
			->where('p_type', 2)
			->where('p_status', 0)
			->orderBy('p_date', 'DESC')
			->findAll();
		foreach ($circulars as $key => $circular) {
			$recipient_ids = json_decode($circular['p_recipients_id']);
			$recipients = [];
			if ($recipient_ids) {
        foreach ($recipient_ids as $recipient_id) {
          array_push($recipients, $this->department->find($recipient_id));
        }
      } else {
        $external_recipients = explode("\n", $circular['p_recipients_id']);
        $circulars[$key]['external_recipients'] = $external_recipients;
      }

			$created_by = $this->user->find($circular['p_by']);
			$circulars[$key]['created_by'] = $created_by['user_name'];
			$circulars[$key]['recipients'] = $recipients;
		}
		return $circulars;
	}

	private function _get_user_circulars() {
		$circulars = $this->post
			->where('p_by', $this->session->user_id)
			->where('p_type', 2)
			->orderBy('p_date', 'DESC')
			->findAll();
		foreach ($circulars as $key => $circular) {
			$circulars[$key]['signed_by'] = $this->user->find($circular['p_signed_by']);
		}
		return $circulars;
	}

	private function _get_circular($circular_id) {
		$circular = $this->post->find($circular_id);
		if ($circular) {
      $written_by = $this->user->find($circular['p_by']);
      $written_by_employee = $this->employee->find($written_by['user_employee_id']);
      $written_by_position = $this->position->find($written_by_employee['employee_position_id']);
      $written_by_department = $this->department->find($written_by_position['pos_id']);
      $circular['written_by'] = $written_by;
      $circular['written_by']['position'] = $written_by_position;
      $circular['written_by']['department'] = $written_by_department;
      // signed by
      $signed_by = $this->user->find($circular['p_signed_by']);
      $signed_by_employee = $this->employee->find($signed_by['user_employee_id']);
      $signed_by_position = $this->position->find($signed_by_employee['employee_position_id']);
      $signed_by_department = $this->department->find($signed_by_position['pos_id']);
      $circular['signed_by'] = $signed_by;
      $circular['signed_by']['position'] = $signed_by_position;
      $circular['signed_by']['department'] = $signed_by_department;

      $circular['attachments'] = $this->pa->where('pa_post_id', $circular_id)->findAll();
      $recipient_ids = json_decode($circular['p_recipients_id']);
      $recipients = [];
      if ($recipient_ids) {
        foreach ($recipient_ids as $recipient_id) {
          array_push($recipients, $this->department->find($recipient_id));
        }
      } else {
        $external_recipients = explode("\n", $circular['p_recipients_id']);
        $circular['external_recipients'] = $external_recipients;
      }
			$circular['recipients'] = $recipients;
			$circular['organization'] = $this->organization->first();
		}
		return $circular;
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
