<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Chat;
use App\Models\Employee;

class ChatController extends BaseController
{
    public function __construct()
    {
        if (session()->get('type') == 1): //employee
            echo view('auth/access_denied');
            exit;
        endif;
        $this->chat = new Chat();
        $this->employee = new Employee();

    }
	public function chat()
	{
	    $data = [
	      'firstTime'=>$this->session->firstTime,
          'username'=>$this->session->username,
          'employees'=>$this->employee->getAllEmployeeExceptAuthUser($this->session->user_employee_id),
          'emp'=>  $this->employee->getEmployeeByUserEmployeeId($this->session->user_employee_id)
        ];
	    return view('pages/chat/chat', $data);
	}

	public function getMessages(){
        $selected_user = $this->request->getVar('user');
        $auth_user = $this->session->user_employee_id;
        $selected_employee = $this->employee->getEmployeeByUserEmployeeId($selected_user);
        $auth_employee = $this->employee->getEmployeeByUserEmployeeId($auth_user);
        //if(!empty($from_user_id)){

            $messages = $this->chat->getMessages();
            //$messages = $this->chat->getMessagesWithUserByUserId($from_user_id, $to_user_id);
            $data = [
                'messages'=>$messages,
                'auth_employee'=>$auth_employee,
                'selected_employee'=>$selected_employee
            ];
            return view('pages/chat/partials/_messages',$data);

       // }
    }

    public function sendMessage(){
        $message = $this->request->getVar('message');
        $user = $this->request->getVar('user');
        $from_user = $this->session->user_employee_id;
        if(!empty($message) && !empty($user)){
            $data = [
                'chat_to_id'=>$user,
                'chat_from_id'=>$from_user,
                'chat_message'=>$message
            ];
            $this->chat->save($data);
            $messages = $this->chat->getMessagesWithUserByUserId($from_user, $user);
            $data = [
                'messages'=>$messages
            ];
            return view('pages/chat/partials/_messages',$data);
        }
    }
}
