<?php

namespace App\Controllers;

use App\Models\Notification;
use App\Models\Organization;
use App\Models\Position;
use App\Models\Post;
use App\Models\UserModel;
use App\Models\Employee;

class Home extends BaseController
{
  private $organization;
  private $notification;
  private $user;
  private $employee;
  private $post;
  private $position;

	public function __construct()
	{
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
		$this->organization = new Organization();
		$this->notification = new Notification();
    $this->user = new UserModel();
    $this->employee = new Employee();
    $this->post = new Post();
    $this->position = new Position();
  }

	public function index()
	{
		$data['username'] = $this->session->user_username;
		$data['firstTime'] = $this->session->firstTime;
		$data['organization'] = $this->organization->first();
		$data['notifications'] = [];
		$data['overview_stats']['memos'] = $this->_count_memos();
		$data['overview_stats']['my_memos'] = $this->_count_my_memos();
		$data['overview_stats']['unsigned_memos'] = $this->_count_unsigned_memos();
		return view('pages/dashboard/index', $data);
	}

	private function _get_notifications() {
		return $this->notification->where('target_id', $this->session->user_id)->findAll();
	}

	private function _count_memos() {
    $user_id = session()->get('user_id');
    $user_data = $this->user->where('user_id', $user_id)->first();
    $employee_id = $user_data['user_employee_id'];
    $employee_data = $this->employee->where('employee_id', $employee_id)->first();
    $position_id = $employee_data['employee_position_id'];
    $memos = $this->post
      ->where('p_status', 2)
      ->where('p_type', 1)
      ->orderBy('p_date', 'DESC')
      ->findAll();
    $new_memos = [];
    foreach ($memos as $memo) {
      $recipient_ids = json_decode($memo['p_recipients_id']);
      $recipients = [];
      if ($recipient_ids) {
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
    }
    return count($new_memos);
  }

  private function _count_my_memos() {
    $memos = $this->post
      ->where('p_by', $this->session->user_id)
      ->where('p_type', 1)
      ->orderBy('p_date', 'DESC')
      ->findAll();
    foreach ($memos as $key => $memo) {
      $memos[$key]['signed_by'] = $this->user->find($memo['p_signed_by']);
    }
    return count($memos);
  }

  private function _count_unsigned_memos() {
    $memos = $this->post
      ->where('p_signed_by', $this->session->user_id)
      ->where('p_type', 1)
      ->where('p_status', 0)
      ->orderBy('p_date', 'DESC')
      ->findAll();
    foreach ($memos as $key => $memo) {
      $recipient_ids = json_decode($memo['p_recipients_id']);
      $recipients = [];
      if ($recipient_ids) {
        foreach ($recipient_ids as $recipient_id) {
          array_push($recipients, $this->position->find($recipient_id));
        }
      } else {
        $external_recipients = explode("\n", $memo['p_recipients_id']);
        $memos[$key]['external_recipients'] = $external_recipients;
      }
      $memos[$key]['written_by'] = $this->user->find($memo['p_by']);
      $memos[$key]['recipients'] = $recipients;
    }
    return count($memos);
  }
}
