<?php

namespace App\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Reminder;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\TaskExecutor;
use App\Models\TaskFeedback;
use App\Models\TaskLog;
use App\Models\UserModel;

class TaskController extends BaseController
{
  public function __construct()
  {
    if (session()->get('type') == 1):
      echo view('auth/access_denied');
      exit;
    endif;
    $this->task = new Task();
    $this->task_executor = new TaskExecutor();
    $this->department = new Department();
    $this->employee = new Employee();
    $this->user = new UserModel();
    $this->position = new Position();
    $this->task_attachment = new TaskAttachment();
    $this->task_log = new TaskLog();
    $this->task_feedback = new TaskFeedback();
      $this->reminder = new Reminder();
  }

	public function index()
	{
    $data['firstTime'] = $this->session->firstTime;
    $data['username'] = $this->session->user_username;
    $data['tasks'] = $this->_get_tasks();
    return view('/pages/task/index', $data);
	}

	public function new_task() {
    if ($this->request->getMethod() == 'get') {
      $data['firstTime'] = $this->session->firstTime;
      $data['username'] = $this->session->user_username;
      $data['department_employees'] = $this->_get_department_employees();
      return view('/pages/task/new-task', $data);
    }
    $post_data = $this->request->getPost();
    $task_data = [
      'task_subject' => $post_data['task_subject'],
      'task_executor' => $post_data['task_executor'],
      'task_creator' => $this->session->user_id,
      'task_priority' => $post_data['task_priority'],
      'task_overview' => $post_data['task_overview'],
      'task_due_date' => $post_data['task_due_date'],
      'task_status' => 0,
    ];
    $task_id = $this->task->insert($task_data);
    if ($task_id) {
	    $this->send_notification('New Task Created', 'You created a new task', $this->session->user_id, site_url('task-details/').$task_id, 'click to view task');
	    if (isset($post_data['task_executors'])) {
        $this->_add_executors($post_data['task_executors'], $task_id);
      }
	    $task_log_data = [
        'tl_task_id' => $task_id,
        'tl_user_id' => $this->session->user_id,
        'tl_action' => 'task_creation',
      ];
      $this->task_log->insert($task_log_data);
      $response['success'] = true;
      $response['message'] = 'Successfully created a new task';
    } else {
      $response['success'] = false;
      $response['message'] = 'There was an error while creating a new task';
    }
    return $this->response->setJSON($response);
  }

  public function task_details($task_id) {
    if ($this->request->getMethod() == 'get') {
      $data['firstTime'] = $this->session->firstTime;
      $data['username'] = $this->session->user_username;
      $data['task'] = $this->_get_task($task_id);
//      print_r($data['task']);
      return view('/pages/task/task-details', $data);
    }
  }

  public function upload_attachment() {
    $file = $this->request->getFile('file');
    $post_data = $this->request->getPost();
    if (!empty($file)) {
      if ($file->isValid() && !$file->hasMoved()) {
        $file_name = time().'_'.$file->getClientName();
        $file->move('uploads/tasks', $file_name);
        $task_attachment_data = [
          'ta_task_id' => $post_data['task_id'],
          'ta_uploader_id' => $this->session->user_id,
          'ta_link' => $file_name,
        ];
        if ($this->task_attachment->save($task_attachment_data)) {
	        $this->send_notification('Task Attachment Uploaded', 'You have uploaded an attachment to a task', $this->session->user_id, site_url('task-details/').$post_data['task_id'], 'click to view task');
	        $executors = $this->task_executor->where('te_task_id', $post_data['task_id'])->findAll();
	        foreach($executors as $executor){
		        $this->send_notification('Task Attachment Uploaded', 'An attachment was uploaded to a task you are assigned to', $executor['te_executor_id'], site_url('task-details/').$post_data['task_id'], 'click to view task');
	        }
          $task_log_data = [
            'tl_task_id' => $post_data['task_id'],
            'tl_user_id' => $this->session->user_id,
            'tl_action' => 'task_attachment_upload',
            'tl_details' => $file_name
          ];
          $this->task_log->insert($task_log_data);
          $response['success'] = true;
          $response['message'] = 'The attachment was successfully uploaded.';
        } else {
          $response['success'] = false;
          $response['message'] = 'An error occurred while uploading the attachment.';
        }
        return $this->response->setJSON($response);
      }
    }
    $response['success'] = false;
    $response['message'] = 'An error occurred while uploading the attachment.';
    return $this->response->setJSON($response);
  }

  public function start_task($task_id) {
    $task = $this->task->find($task_id);
    if ($task && $task['task_status'] == 0) {
      $task_data = [
        'task_id' => $task_id,
        'task_status' => 1,
      ];
      if ($this->task->save($task_data)) {
	      $this->send_notification('Task Started', 'You have started a task', $this->session->user_id, site_url('task-details/').$task_id, 'click to view task');
	      $task_log_data = [
          'tl_task_id' => $task['task_id'],
          'tl_user_id' => $this->session->user_id,
          'tl_action' => 'task_started',
        ];
        $this->task_log->insert($task_log_data);
        $executors = $this->task_executor->where('te_task_id', $task['task_id'])->findAll();
        if(!empty($executors)){
            foreach($executors as $executor){
	            $this->send_notification('Task Started', 'A task you are assigned to has started', $executor['te_executor_id'], site_url('task-details/').$task_id, 'click to view task');
	            $this->_add_reminder($task['task_id'], $executor['te_executor_id']);
            }
        }
        $response['success'] = true;
        $response['message'] = 'The task was successfully started.';
      } else {
        $response['success'] = false;
        $response['message'] = 'An error occurred while starting the task.';
      }
    } else {
      $response['success'] = false;
      $response['message'] = 'An error occurred while starting the task.';
    }
    return $this->response->setJSON($response);
  }

  public function cancel_task() {
    $post_data = $this->request->getPost();
    $task = $this->task->find($post_data['task_id']);
    if ($task && ($task['task_status'] == 0 || $task['task_status'] == 1)) {
      $task_data = [
        'task_id' => $task['task_id'],
        'task_status' => 3
      ];
      if ($this->task->save($task_data)) {
	      $this->send_notification('Task Cancelled', 'You have cancelled a task', $this->session->user_id, site_url('task-details/').$task['task_id'], 'click to view task');
	      $executors = $this->task_executor->where('te_task_id', $task['task_id'])->findAll();
	      foreach($executors as $executor){
		      $this->send_notification('Task Cancelled', 'A task you are assigned to is cancelled', $executor['te_executor_id'], site_url('task-details/').$task['task_id'], 'click to view task');
	      }
	      $task_log_data = [
          'tl_task_id' => $task['task_id'],
          'tl_user_id' => $this->session->user_id,
          'tl_action' => 'task_cancellation',
          'tl_details' => $post_data['cancellation_reason']
        ];
        $this->task_log->insert($task_log_data);
        $response['success'] = true;
        $response['message'] = 'The task was successfully cancelled.';
      } else {
        $response['success'] = false;
        $response['message'] = 'An error occurred while cancelling the task.';
      }
    } else {
      $response['success'] = false;
      $response['message'] = 'An error occurred while cancelling the task.';
    }
    return $this->response->setJSON($response);
  }

  public function complete_task() {
    $post_data = $this->request->getPost();
    $task = $this->task->find($post_data['task_id']);
    if ($task && $task['task_status'] == 1) {
      $task_data = [
        'task_id' => $task['task_id'],
        'task_status' => 2
      ];
      if ($this->task->save($task_data)) {
	      $this->send_notification('Task Completed', 'You have completed a task', $this->session->user_id, site_url('task-details/').$task['task_id'], 'click to view task');
	      $executors = $this->task_executor->where('te_task_id', $task['task_id'])->findAll();
	      foreach($executors as $executor){
		      $this->send_notification('Task Completed', 'A task you are assigned to is completed', $executor['te_executor_id'], site_url('task-details/').$task['task_id'], 'click to view task');
	      }
	      $task_log_data = [
          'tl_task_id' => $task['task_id'],
          'tl_user_id' => $this->session->user_id,
          'tl_action' => 'task_completion',
          'tl_details' => $post_data['completion_summary']
        ];
        $this->task_log->insert($task_log_data);
        $response['success'] = true;
        $response['message'] = 'The task was successfully completed.';
      } else {
        $response['success'] = false;
        $response['message'] = 'An error occurred while completing the task.';
      }
    } else {
      $response['success'] = false;
      $response['message'] = 'An error occurred while completing the task.';
    }
    return $this->response->setJSON($response);
  }

  public function submit_feedback() {
    $post_data = $this->request->getPost();
    $task = $this->task->find($post_data['task_id']);
    if ($task && $task['task_status'] == 1) {
      $task_feedback_data = [
        'tf_task_id' => $task['task_id'],
        'tf_user_id' => $this->session->user_id,
        'tf_comment' => $post_data['comment']
      ];
      if ($this->task_feedback->save($task_feedback_data)) {
	      $this->send_notification('Task Feedback Submitted', 'You have submitted a feedback on a task', $this->session->user_id, site_url('task-details/').$task['task_id'], 'click to view task');
	      $executors = $this->task_executor->where('te_task_id', $task['task_id'])->findAll();
	      foreach($executors as $executor){
		      $this->send_notification('Task Feedback Submitted', 'Feedback was submitted on a task you are assigned to', $executor['te_executor_id'], site_url('task-details/').$task['task_id'], 'click to view task');
	      }
	      $task_log_data = [
          'tl_task_id' => $task['task_id'],
          'tl_user_id' => $this->session->user_id,
          'tl_action' => 'feedback_submit',
          'tl_details' => $post_data['comment']
        ];
        $this->task_log->insert($task_log_data);
        $response['success'] = true;
        $response['message'] = 'Your feedback was submitted.';
      } else {
        $response['success'] = false;
        $response['message'] = 'An error occurred while submitting your feedback.';
      }
    } else {
      $response['success'] = false;
      $response['message'] = 'An error occurred while submitting your feedback.';
    }
    return $this->response->setJSON($response);
  }

  public function view_task_log($task_id) {
    $data['firstTime'] = $this->session->firstTime;
    $data['username'] = $this->session->user_username;
    $data['task'] = $this->_get_task($task_id);
    $data['task_logs'] = $this->_get_task_logs($task_id);
    return view('/pages/task/view-task-logs', $data);
  }

  private function _get_task_logs($task_id) {
    $task_logs = $this->task_log->where('tl_task_id', $task_id)->orderBy('created_at', 'DESC')->findAll();
    foreach ($task_logs as $key => $task_log) {
      $task_logs[$key]['user'] = $this->user->find($task_log['tl_user_id']);
    }
    return $task_logs;
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

  private function _add_executors($executors, $task_id) {
    if (count($executors) > 0) {
        $task = $this->task->find($task_id);
      foreach ($executors as $executor) {
        $executor_data = [
          'te_task_id' => $task_id,
          'te_executor_id' => $executor,
          'te_status' => 1
        ];
        $this->task_executor->save($executor_data);
	      $this->send_notification('New Task Created', 'You were assigned as an executor on a new task', $executor, site_url('task-details/').$task_id, 'click to view task');
      }
    }
  }

  public function _add_reminder($id, $employee){
      $task = $this->task->find($id);
      if(!empty($task)){
          $remind = [
              'title'=>$task['task_subject'],
              'reminder_start_date'=>date('Y-m-d'),
              'reminder_end_date'=>$task['task_due_date'],
              'reminder_employee_id'=>$employee
          ];
          $this->reminder->save($remind);
      }
  }

  private function _get_tasks() {
    $tasks = $this->task->findAll();
    foreach ($tasks as $key => $task) {
      $task_executors = $this->task_executor->where('te_task_id', $task['task_id'])->findAll();
      $task_executor_ids = [];
      foreach ($task_executors as $task_executor)
        array_push($task_executor_ids, $task_executor['te_executor_id']);
      if ($task['task_executor'] != $this->session->user_id &&
        $task['task_creator'] != $this->session->user_id &&
        !in_array($this->session->user_id, $task_executor_ids)) {
        unset($tasks[$key]);
      } else {
        $creator = $this->user->find($task['task_creator']);
        $executor = $this->user->find($task['task_executor']);
        $tasks[$key]['creator'] = $creator;
        $tasks[$key]['executor'] = $executor;
      }
    }
    return $tasks;
  }

  private function _get_task($task_id) {
    $task = $this->task->find($task_id);
    if ($task) {
      $task['primary_executor'] = $this->user->find($task['task_executor']);
      $task['creator'] = $this->user->find($task['task_creator']);
      $task['attachments'] = $this->task_attachment->where('ta_task_id', $task_id)->findAll();
      $task['secondary_executors'] = [];
      $secondary_executors = $this->task_executor->where('te_task_id', $task_id)->findAll();
      foreach ($secondary_executors as $secondary_executor) {
        $task['secondary_executors'][] = $this->user->find($secondary_executor['te_executor_id']);
      }
      $task_feedbacks = $this->task_feedback->where('tf_task_id', $task_id)->findAll();
      foreach ($task_feedbacks as $key => $task_feedback) {
        $task_feedbacks[$key]['user'] = $this->user->find($task_feedback['tf_user_id']);
      }
      $task['task_feedbacks'] = $task_feedbacks;
    }
    return $task;
  }
}
