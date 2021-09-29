<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Department;
use App\Models\Employee;
use App\Models\UserModel;
use App\Models\WorkflowConversation;
use App\Models\WorkflowExceptionProcessor;
use App\Models\WorkflowProcessor;
use App\Models\WorkflowRequest;
use App\Models\WorkflowRequestAttachment;
use App\Models\WorkflowResponsiblePerson;
use App\Models\WorkflowType;

class WorkflowController extends BaseController
{

    public function __construct()
    {
      /*  if (session()->get('type') == 1):
            echo view('auth/access_denied');
            exit;
        endif;*/
        $this->user = new UserModel();
        $this->department = new Department();
        $this->workflowtype = new WorkflowType();
        $this->workflowprocessor = new WorkflowProcessor();
        $this->workflowexceptionprocessor = new WorkflowExceptionProcessor();
        $this->workflowrequest = new WorkflowRequest();
        $this->workflowrequestattachment = new WorkflowRequestAttachment();
        $this->employee = new Employee();
        $this->workflowresponsibleperson = new WorkflowResponsiblePerson();
        $this->workflowconversation = new WorkflowConversation();
    }

	public function settings()
	{
	    $data = [
	      'workflow_types'=>$this->workflowtype->getAllWorkflowTypes(),
          'departments'=>$this->department->getAllDepartments(),
          'employees'=>$this->user->getAllUsers(),
          'processors'=>$this->workflowprocessor->getAllProcessors(),
          'ex_processors'=>$this->workflowexceptionprocessor->getAllExceptionProcessors(),
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username,
        ];
		return view('pages/workflow/settings', $data);
	}

	public function storeNewWorkflowType(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $name = $this->request->getPost('workflow_type');
            if(isset($name)){
                $data = [
                  'workflow_type_name'=>$name,
                    'added_by'=>$this->session->user_id,
                ];
                $this->workflowtype->save($data);
                return redirect()->back()->with("success", "<strong>Success!</strong> Your workflow name was registered successfully.");
            }else{
                return redirect()->back()->with("error", "<strong>Whoops!</strong> Enter workflow name.");
            }

        }
    }
    public function updateWorkflowType(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $name = $this->request->getPost('workflow_type');
            if(isset($name)){
                $data = [
                  'workflow_type_name'=>$name,
                    'added_by'=>$this->session->user_id,
                ];
                $this->workflowtype->update($this->request->getPost('workflow_index'), $data);
                return redirect()->back()->with("success", "<strong>Success!</strong> Your changes were saved successfully.");
            }else{
                return redirect()->back()->with("error", "<strong>Whoops!</strong> Enter workflow name.");
            }

        }
    }

    public function setupWorkflowProcessor(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $department = $this->request->getPost('department');
            $employee = $this->request->getPost('employee');
            $type = $this->request->getPost('workflow_type');
            $data = [
                'w_flow_added_by' => $this->session->user_id,
                'w_flow_employee_id'=>$employee,
                'w_flow_department_id'=>$department,
                'w_flow_type_id'=>$type
            ];
            $this->workflowprocessor->save($data);
            return redirect()->back()->with("success", "<strong>Success!</strong> Workflow processor set.");
        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> All fields are required.");
        }

    }
    public function updateWorkflowProcessor(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $department = $this->request->getPost('department');
            $employee = $this->request->getPost('employee');
            $type = $this->request->getPost('workflow_type');
            $data = [
                'w_flow_added_by' => $this->session->user_id,
                'w_flow_employee_id'=>$employee,
                'w_flow_department_id'=>$department,
                'w_flow_type_id'=>$type
            ];
            $this->workflowprocessor->update($this->request->getPost('workflow_processor'), $data);
            return redirect()->back()->with("success", "<strong>Success!</strong> Your changes were saved successfully.");
        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> All fields are required.");
        }

    }

    #Exception
    public function setupExceptionWorkflowProcessor(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $department = $this->request->getPost('department');
            $employee = $this->request->getPost('employee');
            $type = $this->request->getPost('workflow_type');
            $data = [
                'w_flow_ex_added_by' => $this->session->user_id,
                'w_flow_ex_employee_id'=>$employee,
                'w_flow_ex_department_id'=>$department,
                'w_flow_ex_type_id'=>$type
            ];
            $this->workflowexceptionprocessor->save($data);
            return redirect()->back()->with("success", "<strong>Success!</strong> Workflow processor set.");
        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> All fields are required.");
        }

    }
    public function updateExceptionWorkflowProcessor()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $to = $this->request->getPost('to');
            $employee = $this->request->getPost('employee');
            $type = $this->request->getPost('workflow_type');
            $data = [
                'w_flow_ex_added_by' => $this->session->user_id,
                'w_flow_ex_employee_id' => $employee,
                'w_flow_ex_to_id' => $to,
                'w_flow_ex_type_id' => $type
            ];
            $this->workflowexceptionprocessor->update($this->request->getPost('workflow_ex_processor'), $data);
            return redirect()->back()->with("success", "<strong>Success!</strong> Your changes were saved successfully.");
        } else {
            return redirect()->back()->with("error", "<strong>Whoops!</strong> All fields are required.");
        }
    }

    public function workflowRequests(){
        $data = [
          'my_requests'=>$this->workflowrequest->getAuthUserWorkflowRequests($this->session->user_id),
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username,
        ];

        return view('pages/workflow/workflow-requests', $data);
    }

    public function createNewWorkflowRequest(){
        $user_employee_id = $this->session->user_employee_id;
        $employee = $this->employee->getEmployeeByUserEmployeeId($user_employee_id);
        if(!empty($employee)){
            if(!empty($employee['employee_department_id'])){
                $data = [
                    'workflow_types'=>$this->workflowtype->getAllWorkflowTypes(),
                    'firstTime'=>$this->session->firstTime,
                    'username'=>$this->session->username,
                ];
                return view('pages/workflow/new-request', $data);
            }else{
                return redirect()->back()->with("error", "<strong>Whoops!</strong> Please update your department.");
            }
        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> There's currently no record for this employee.");
        }

    }

    public function setNewWorkflowRequest(){
        if ($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $input = $this->validate([
                'title' => 'required',
                'description' => 'required',
                'workflow_type' => 'required'
            ]);
            if(!$input){
                echo view('pages/workflow/new-request', [
                    'validation' => $this->validator,
                    'workflow_types'=>$this->workflowtype->getAllWorkflowTypes(),
                    'firstTime'=>$this->session->firstTime,
                    'username'=>$this->session->username,
                ]);
            }else{
                $title = $this->request->getPost('title');
                $description = $this->request->getPost('description');
                $amount = $this->request->getPost('amount');
                $workflow_type = $this->request->getPost('workflow_type');
                $user_employee_id = $this->session->user_employee_id;
                $employee = $this->employee->getEmployeeByUserEmployeeId($user_employee_id);
                $department = $employee['employee_department_id'];
                #Exception processors
                $exception_list = $this->workflowexceptionprocessor->checkExceptionList($user_employee_id, $workflow_type);
                #Normal
                $normal_list = $this->workflowprocessor->checkNormalList($user_employee_id, $workflow_type, $department);
                if(!empty($exception_list)){
                    $request_id = $this->postRequest();
                    $this->publishResponsiblePersons($exception_list['w_flow_ex_to_id'], $request_id);
                    return redirect()->back()->with("success", "<strong>Success!</strong> Your request was submitted successfully.");
                }elseif(!empty($normal_list)){
                    $request_id = $this->postRequest();
                    $this->publishResponsiblePersons($exception_list['w_flow_ex_to_id'], $request_id);
                    return redirect()->back()->with("success", "<strong>Success!</strong> Your request was submitted successfully.");
                }else{
                    return redirect()->back()->with("error", "<strong>Whoops!</strong> Something went wrong.");
                }

                /*$data = [
                    'requested_by' => $this->session->user_id,
                    'requested_type_id' => $workflow_type,
                    'request_title' => $title,
                    'request_description' => $description,
                    'amount'=>$amount
                ];
                $workflow_request_id = $this->workflowrequest->insert($data);
                #Process attachments
                if(!empty($workflow_request_id)){
                    if($this->request->getFileMultiple('attachments')){
                        foreach ($this->request->getFileMultiple('attachments') as $attachment){
                            if($attachment->isValid() ){
                                $extension = $attachment->guessExtension();
                                $filename = $attachment->getRandomName();
                                $attachment->move('uploads/posts', $filename);
                                $request_attachment = [
                                    'workflow_request_id' => $workflow_request_id,
                                    'attachment' => $filename
                                ];
                                $this->workflowrequestattachment->save($request_attachment);
                            }
                        }
                    }
                }*/

            }

        }
    }


    public function postRequest(){
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $amount = $this->request->getPost('amount');
        $workflow_type = $this->request->getPost('workflow_type');
        $data = [
            'requested_by' => $this->session->user_id,
            'requested_type_id' => $workflow_type,
            'request_title' => $title,
            'request_description' => $description,
            'amount'=>$amount
        ];
        $workflow_request_id = $this->workflowrequest->insert($data);
        $this->send_notification('New Workflow Request', 'You have submitted a new workflow request', $this->session->user_id, site_url('/workflow-requests/view/'.$workflow_request_id), 'click to view workflow request');
        #Process attachments
        if(!empty($workflow_request_id)){
            if($this->request->getFileMultiple('attachments')){
                foreach ($this->request->getFileMultiple('attachments') as $attachment){
                    if($attachment->isValid() ){
                        $extension = $attachment->guessExtension();
                        $filename = $attachment->getRandomName();
                        $attachment->move('uploads/posts', $filename);
                        $request_attachment = [
                            'workflow_request_id' => $workflow_request_id,
                            'attachment' => $filename
                        ];
                        $this->workflowrequestattachment->save($request_attachment);
                    }
                }
            }
        }
        return $workflow_request_id;
    }

    public function publishResponsiblePersons($directed_to, $request_id){
        $data = [
            'redirected_to_id'=>$directed_to,
            'request_id'=>$request_id,
        ];
        $this->workflowresponsibleperson->save($data);
        $user = $this->user->where('user_employee_id', $directed_to);
	      $this->send_notification('New Workflow Request', 'You have been assigned to act on a workflow request', $user['user_id'], site_url('/workflow-requests/view/'.$request_id), 'click to view workflow request');
    }


    public function viewWorkflowRequest($id){
        $request = $this->workflowrequest->getWorkflowRequestDetail($id);

        if(!empty($request)){
            $data = [
              'workflow_request'=>$request,
              'workflow_attachments'=>$this->workflowrequestattachment->getWorkflowRequestAttachments($id),
              'responsible_persons'=>$this->workflowresponsibleperson->getWorkflowResponsiblePersonsByRequestId($id),
                'auth_user'=>$this->session->user_employee_id,
                'comments'=>$this->workflowconversation->getWorkflowConversationByRequestId($id),
                'firstTime'=>$this->session->firstTime,
                'username'=>$this->session->username,
            ];
            return view('pages/workflow/view-workflow-request', $data);
        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> No record found.");
        }

    }

    public function processWorkflowRequest(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            if ($this->request->getMethod() == 'post') {
                helper(['form', 'url']);
                $input = $this->validate([
                    'request' => 'required',
                    'action' => 'required',
                    'workflow_responsible'=>'required'
                ]);
                if(!$input){
                    return redirect()->back()->with("error", "<strong>Whoops!</strong> Something went wrong. Try again.");
                }else{
                    $request_id = $this->request->getPost('request');
                    $action = $this->request->getPost('action');
                    $workflow_responsible_id = $this->request->getPost('workflow_responsible');
                    //return var_dump($workflow_responsible_id);
                    if($action == 1 || $action == 2){
                        $data = [
                            'request_id'=>$request_id,
                            'request_status'=>$action
                        ];
                        if($action == 1){
                            $request = $this->workflowrequest->where('workflow_request_id', $request_id)->first();
                            $this->workflowresponsibleperson->update($workflow_responsible_id, $data);
	                        $this->send_notification('Workflow Request Approved', 'You have approved a workflow request', $this->session->user_id, site_url('/workflow-requests/view/'.$request_id), 'click to view workflow request');
	                        $employee = $this->employee->getEmployeeByUserEmployeeId($request['requested_by']);
	                        $user = $this->user->where('user_employee_id', $employee['employee_id']);
	                        $this->send_notification('Workflow Request Approved', 'Your workflow request was approved', $user['user_id'], site_url('/workflow-requests/view/'.$request_id), 'click to view workflow request');
	                        #Exception processors
                            $exception_list = $this->workflowexceptionprocessor->checkAllExceptionList($request['requested_by'], $request['requested_type_id']);
                            #Normal
                            $normal_list = $this->workflowprocessor->checkAllNormalList($request['requested_by'], $request['requested_type_id'], $employee['employee_department_id']);
                            #Get list of those who have acted on this request
                            $published_res_persons = $this->workflowresponsibleperson->getPublishedResponsiblePersons($request_id);
                            $publishedList = [];
                            foreach($published_res_persons as $publist){
                                array_push($publishedList, $publist['redirected_to_id']);
                            }
                            $normalListArray = [];
                            foreach($normal_list as $normal){
                                array_push($normalListArray, $normal['w_flow_employee_id']);
                            }
                            #Get list of pending processors
                            $remainingProcessors = array_values(array_diff($normalListArray, $publishedList));
                            #Check list of exceptions
                            $exceptionListArray = [];
                            foreach($exception_list as $list){
                                array_push($exceptionListArray, $list['w_flow_ex_to_id']);
                            }
                            $remainingException = array_values(array_diff($exceptionListArray, $publishedList));
                            if(!empty($remainingException)){
                                $this->publishResponsiblePersons($remainingException[0], $request_id);
                                return redirect()->back()->with("success", "<strong>Success!</strong> Workflow request approved.");
                            }else{
                                #Publish new responsible person from the processor list
                                if(!empty($remainingProcessors)){
                                    $this->publishResponsiblePersons($remainingProcessors[0], $request_id);
                                    return redirect()->back()->with("success", "<strong>Success!</strong> Workflow request approved.");
                                }else{
                                    #Now; both exception list and that of processor list are empty
                                    #If both exception list and that of processor list is empty; mark request as completed
                                    //$this->workflowresponsibleperson->update($workflow_responsible_id, $data);
                                    $update = [
                                        'request_status'=>1
                                    ];
                                    $this->workflowrequest->update($request_id, $update);
                                    return redirect()->back()->with("success", "<strong>Success!</strong> Workflow request approved.");
                                }
                            }
                        }else{
                            $this->workflowresponsibleperson->update($workflow_responsible_id, $data);
                            $update = [
                                'request_status'=>2
                            ];
                            $this->workflowrequest->update($request_id, $update);
	                        $this->send_notification('Workflow Request Declined', 'You have declined a workflow request', $this->session->user_id, site_url('/workflow-requests/view/'.$request_id), 'click to view workflow request');
	                        $request = $this->workflowrequest->where('workflow_request_id', $request_id)->first();
	                        $employee = $this->employee->getEmployeeByUserEmployeeId($request['requested_by']);
	                        $user = $this->user->where('user_employee_id', $employee['employee_id']);
	                        $this->send_notification('Workflow Request Declined', 'Your workflow request was declined', $user['user_id'], site_url('/workflow-requests/view/'.$request_id), 'click to view workflow request');
	                        return redirect()->back()->with("success", "<strong>Success!</strong> Workflow request declined.");
                        }
                        #Check for next approval

                    }else{
                        return redirect()->back()->with("error", "<strong>Whoops!</strong> Unknown action taken. Try again.");
                    }
                }
            }
        }
    }

    public function leaveComment()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            if ($this->request->getMethod() == 'post') {
                helper(['form', 'url']);
                $input = $this->validate([
                    'leave_comment' => 'required',
                    'workflow_comment' => 'required'
                ]);
                if (!$input) {
                    return redirect()->back()->with("error", "<strong>Whoops!</strong> Something went wrong. Try again.");
                } else {
                    $comment = $this->request->getPost('leave_comment');
                    $workflow = $this->request->getPost('workflow_comment');
                    $data = [
                        'request_id'=>$workflow,
                        'comment'=>$comment,
                        'commented_by'=>$this->session->user_id
                    ];
                    $this->workflowconversation->save($data);
                    return redirect()->back()->with("success", "<strong>Success!</strong> Comment registered.");
                }
            }
        }
    }

}
