<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Reminder;

class ReminderController extends BaseController
{
    public function __construct()
    {
        if (session()->get('type') == 1): //employee
            echo view('auth/access_denied');
            exit;
        endif;
        $this->reminder = new Reminder();

    }

	public function index()
	{

	    $data = [
	      'firstTime'=>$this->session->firstTime,
          'username'=>$this->session->username,
          'employee_id'=>$this->session->user_employee_id
        ];
		return view('pages/reminder/index',$data);
	}

	public function loadCalendar(){
        $reminder_events = $this->reminder->fetchAllReminders($this->session->user_employee_id);
        foreach($reminder_events as $re){
            $reminder = array(
                'id'=>$re['reminder_id'],
                'title'=>$re['title'],
                'start'=>$re['reminder_start_date'],
                'end'=>$re['reminder_end_date'],
            );
        }
        echo json_encode($reminder);
    }
	public function insert(){
        $data = [
            'title'=>$this->request->getPost('title'),
            'reminder_start_date'=>$this->request->getPost('reminder_start_date'),
            'reminder_end_date'=>$this->request->getPost('reminder_end_date'),
            'reminder_employee_id'=>$this->request->getPost('reminder_employee_id')
        ];
        $this->reminder->insert($data);
    }
}
