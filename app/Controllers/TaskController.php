<?php

namespace App\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Task;
use App\Models\TaskExecutor;
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
  }

	public function index()
	{
    $data['firstTime'] = $this->session->firstTime;
    $data['username'] = $this->session->user_username;
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
      if (isset($post_data['task_executors'])) {
        $this->_add_executors($post_data['task_executors'], $task_id);
      }
      $response['success'] = true;
      $response['message'] = 'Successfully created a new task';
    } else {
      $response['success'] = false;
      $response['message'] = 'There was an error while creating a new task';
    }
    return $this->response->setJSON($response);
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
      foreach ($executors as $executor) {
        $executor_data = [
          'te_task_id' => $task_id,
          'te_executor_id' => $executor,
          'te_status' => 1
        ];
        $this->task_executor->save($executor_data);
      }
    }
  }
}
