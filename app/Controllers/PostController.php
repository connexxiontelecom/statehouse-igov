<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Notice;
use App\Models\Organization;
use App\Models\Position;
use App\Models\Post;
use App\Models\PostAttachment;
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
		$this->department = new Department();
		$this->position = new Position();
		$this->pa = new PostAttachment();
		$this->organization = new Organization();
	}
	
	public function circulars() {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$circulars = array();
		$posts = $this->post->where('p_type', 2)
//				->where('p_status', 3)
			->join('users', 'posts.p_signed_by = users.user_id')
			->orderBy('posts.p_date', 'DESC')
			->paginate('9');
		$l_user = $this->user->where('user_username', $this->session->user_username)
			->join('employees', 'users.user_employee_id = employees.employee_id')
			->first();
		
		$department_id = $l_user['employee_department_id'];
		$i = 0;
		foreach ($posts as $post):
			$posts_dpts = json_decode($post['p_recipients_id']);
		
		if(in_array($department_id, $posts_dpts)):
				$circulars[$i] = $post;
				$i++;
			endif;
		endforeach;
		
		$i =0;
		
		$new_circulars = array();
		foreach ($circulars as $circular):
			$user = $this->user->where('user_id', $circular['p_by'])->first();
			$circular['created_by'] = $user['user_name'];
			$new_circulars[$i] = $circular;
			$i++;
		endforeach;
		$data['pager'] = $this->post->pager;
		$data['circulars'] = $new_circulars;
		return view('/pages/posts/circulars', $data);
	}
	
	public function new_circular() {
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
		
			return view('/pages/posts/new-circular', $data);
		
		endif;
	}
	
	public function upload_post_attachments(){
		$file = $this->request->getFile('file');
		if($file->isValid() && !$file->hasMoved()):
			$file_name = $file->getClientName();
			$file->move('uploads/posts', $file_name);
			echo $file_name;
		endif;
		
	}
	
	public function delete_post_attachments(){
	$file = $this->request->getPostGet('files');
	$directory = 'uploads/posts/'.$file;
		if(unlink($directory)):

			$response['message'] = 'Deleted Successful';
		else:
			$response['message'] = 'An error Occurred';
			endif;
		return $this->response->setJSON($response);
	}
	
	public function internal_circular(){
		if($this->request->getMethod() == 'get'):
			$data['signed_by'] = $this->user->where('user_status', 1)
				->groupStart()
				->where('user_type', 2)
				->orWhere('user_type', 3)
				->groupEnd()
				->findAll();
			$data['departments']= $this->department->findAll();
			$data['pager'] = $this->post->pager;
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			return view('/pages/posts/new-internal-circular', $data);
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
				
				if(count($p_attachments) > 0):
					foreach ($p_attachments as $attachment):
						$attachment_array = array(
							'pa_post_id'=> $p_id,
							'pa_link' => $attachment
						);
						$this->pa->save($attachment_array);
					endforeach;
				endif;
				$response['success'] = true;
				$response['message'] = 'Successfully created Circular';
			 else:
				$response['success'] = false;
				$response['message'] = 'There was an error while creating Circular ';
			endif;
			return $this->response->setJSON($response);
		
		endif;
	}
	
	public function view_circular($p_id){
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$attachments = array();
		$post = $this->post->where('p_id', $p_id)
			->join('users', 'posts.p_signed_by = users.user_id')
			->first();
		
		$user = $this->user->where('user_id', $post['p_by'])->first();
		$post['created_by'] = $user['user_name'];
		$_attachments = $this->pa->where('pa_post_id', $p_id)->findAll();
			if(!empty($_attachments)):
				$attachments = $_attachments;
			endif;
			
			$dpts = json_decode($post['p_recipients_id']);
			$departments = array();
			$i = 0;
			foreach ($dpts as $dpt):
				$_dpt = $this->department->where('dpt_id', $dpt)->first();
				$departments[$i] = $_dpt['dpt_name'];
				$i++;
			endforeach;
			
		$data['departments'] = $departments;
		$data['post'] = $post;
		$data['attachments'] = $attachments;
		$data['organization'] = $this->organization->first();
		
		
	
		return view('/pages/posts/view-circular', $data);
	}
	
	public function external_circular(){
		
		$data['signed_by'] = $this->user->where('user_status', 1)
			->groupStart()
			->where('user_type', 2)
			->orWhere('user_type', 3)
			->groupEnd()
			->findAll();
		$data['departments']= $this->department->findAll();
		$data['pager'] = $this->post->pager;
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		return view('/pages/posts/new-external-circular', $data);
	}
	
	public function my_circulars(){
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$l_user = $this->user->where('user_username', $this->session->user_username)
			->join('employees', 'users.user_employee_id = employees.employee_id')
			->first();
		$circulars = $this->post->where('p_type', 2)
								->where('p_by', $l_user['user_id'])
								->join('users', 'posts.p_signed_by = users.user_id')
								->paginate('9');
		$new_circulars = array();
		$i = 0;
		foreach ($circulars as $circular):
			$user = $this->user->where('user_id', $circular['p_by'])->first();
			$circular['created_by'] = $user['user_name'];
			$new_circulars[$i] = $circular;
			$i++;
		endforeach;
		$data['pager_cir'] = $this->post->pager;
		$data['circulars'] = $new_circulars;
		
		
		$circulars = $this->post->where('p_type', 2)
			->where('p_signed_by', $l_user['user_id'])
			->join('users', 'posts.p_signed_by = users.user_id')
			->paginate('9');
		$new_circulars = array();
		$i = 0;
		foreach ($circulars as $circular):
			$user = $this->user->where('user_id', $circular['p_by'])->first();
			$circular['created_by'] = $user['user_name'];
			$new_circulars[$i] = $circular;
			$i++;
		endforeach;
		$data['pager_scir'] = $this->post->pager;
		$data['s_circulars'] = $new_circulars;
		
		return view('/pages/posts/my-circulars', $data);
	}

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
				return view('/pages/posts/my-signed-memos', $data);
			}
			$data['memos'] = $this->_get_memos($position_id);
		} else {
			$data['memos'] = $this->_get_searched_memos($search_params, $position_id);
		}
		$data['pager'] = $this->post->pager;
		
		return view('/pages/posts/memos', $data);
	}

	public function my_memos($type = null) {
		$user_id = session()->get('user_id');
		$user_data = $this->user->where('user_id', $user_id)->first();
		$employee_id = $user_data['user_employee_id'];
		$employee_data = $this->employee->where('employee_id', $employee_id)->first();
		$position_id = $employee_data['employee_position_id'];
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['memos'] = $this->_get_user_memos($position_id);
		return view('/pages/posts/my-memos', $data);
	}
	
	public function new_memo() {
		
		if($this->request->getMethod() == 'post'):
		
		
		endif;
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			return view('/pages/posts/new-memo', $data);
		
		endif;
		
		
	}
	
	public function internal_memo(){
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
			return view('/pages/posts/new-internal-memo', $data);
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
			return view('/pages/posts/new-external-memo', $data);
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

	public function view_memo($memo_id) {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['memo'] = $this->_get_memo($memo_id);
		return view('/pages/posts/view-memo', $data);
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
			$data['pager'] = $this->post->pager;
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['memo'] = $this->_get_memo($memo_id);
			return view('/pages/posts/edit-internal-memo', $data);
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

	public function send_doc_signing_verification() {
		$post_data = $this->request->getPost();
		$post_id = $post_data['p_id'];
		$post = $this->post->find($post_id);
		$user = $this->user->find(session()->user_id);
		$employee = $this->employee->find($user['user_employee_id']);
		$organization = $this->organization->first();
		$to = $employee['employee_mail'];
		$subject = 'Verify Document Signing';
		$data['subject'] = $subject;
		$data['user'] = $user['user_name'];
		$data['organization'] = $organization['org_name'];
		$data['ver_code'] = $this->_get_verification_code('doc_signing');
		$data['post'] = $post;
		$message = view('email/doc-signing-otp', $data);
		$from['name'] = 'IGOV by Connexxion Telecom';
		$from['email'] = 'support@connexxiontelecom.com';
		if ($this->send_mail($to, $subject, $message, $from)) {
			$response['success'] = true;
			$response['message'] = 'A document signing verification code has been sent to your email.';
		} else {
			$response['success'] = false;
			$response['message'] = 'An error occurred while sending your document signing verification code';
		}
		return $this->response->setJSON($response);
	}

	public function sign_post() {
		$post_request_data = $this->request->getPost();
		$post = $this->post->find($post_request_data['p_id']);
		if ($post['p_signed_by'] != session()->user_id) {
			$response['success'] = false;
			$response['message'] = 'You have not been assigned to sign this document.';
			return $this->response->setJSON($response);
		} else if ($post['p_status'] != 0) {
			$response['success'] = false;
			$response['message'] = 'This document has been processed. No further actions can be taken at this time.';
			return $this->response->setJSON($response);
		}
		$post_data = [
			'p_id' => $post_request_data['p_id'],
			'p_status' => 2,
			'p_signature' => $post_request_data['p_signature']
		];
		if ($this->post->save($post_data)) {
			$response['success'] = true;
			$response['message'] = 'The document was signed successfully';
		} else {
			$response['success'] = false;
			$response['message'] = 'An error occurred while signing this document';
		}
		return $this->response->setJSON($response);
	}

	public function decline_post() {
		$post_request_data = $this->request->getPost();
		$post = $this->post->find($post_request_data['p_id']);
		if ($post['p_signed_by'] != session()->user_id) {
			$response['success'] = false;
			$response['message'] = 'You have not been assigned to sign this document.';
			return $this->response->setJSON($response);
		} else if ($post['p_status'] != 0) {
			$response['success'] = false;
			$response['message'] = 'This document has been processed. No further actions can be taken at this time.';
			return $this->response->setJSON($response);
		}
		$post_data = [
			'p_id' => $post_request_data['p_id'],
			'p_status' => 4,
		];
		if ($this->post->save($post_data)) {
			$response['success'] = true;
			$response['message'] = 'The document was successfully declined';
		} else {
			$response['success'] = false;
			$response['message'] = 'An error occurred while declining this document';
		}
		return $this->response->setJSON($response);
	}

	private function _upload_attachments($attachments, $post_id) {
		if (count($attachments) > 0) {
			foreach ($attachments as $attachment) {
				$attachment_data = array(
					'pa_post_id' => $post_id,
					'pa_link' => $attachment
				);
				$this->pa->save($attachment_data);
			}
		}
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
			if (in_array($position_id, $recipient_ids)) {
				$memo['written_by'] = $this->user->find($memo['p_by']);
				$memo['signed_by'] = $this->user->find($memo['p_signed_by']);
				$memo['recipients'] = $recipients;
				array_push($new_memos, $memo);
			}
		}
		return $new_memos;
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

	private function _get_searched_memos($search_params, $position_id) {
		$memos = $this->post
			->where('p_status', 2)
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

	private function _get_user_memos($position_id) {
		$memos = $this->post
			->where('p_by', $this->session->user_id)
			->where('p_type', 1)
			->orderBy('p_date', 'DESC')
			->findAll();
		$new_memos = [];
		foreach ($memos as $memo) {
			$recipient_ids = json_decode($memo['p_recipients_id']);
			$recipients = [];
			foreach ($recipient_ids as $recipient_id) {
				array_push($recipients, $this->position->find($recipient_id));
			}
			if (in_array($position_id, $recipient_ids)) {
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
}
