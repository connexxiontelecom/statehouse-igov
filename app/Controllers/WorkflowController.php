<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Department;
use App\Models\UserModel;
use App\Models\WorkflowExceptionProcessor;
use App\Models\WorkflowProcessor;
use App\Models\WorkflowRequest;
use App\Models\WorkflowRequestAttachment;
use App\Models\WorkflowType;

class WorkflowController extends BaseController
{

    public function __construct()
    {
        if (session()->get('type') == 1):
            echo view('auth/access_denied');
            exit;
        endif;
        $this->user = new UserModel();
        $this->department = new Department();
        $this->workflowtype = new WorkflowType();
        $this->workflowprocessor = new WorkflowProcessor();
        $this->workflowexceptionprocessor = new WorkflowExceptionProcessor();
        $this->workflowrequest = new WorkflowRequest();
        $this->workflowrequestattachment = new WorkflowRequestAttachment();
    }

	public function settings()
	{
	    $data = [
	      'workflow_types'=>$this->workflowtype->getAllWorkflowTypes(),
          'departments'=>$this->department->getAllDepartments(),
          'employees'=>$this->user->getAllUsers(),
          'processors'=>$this->workflowprocessor->getAllProcessors(),
          'ex_processors'=>$this->workflowexceptionprocessor->getAllExceptionProcessors()
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
            $department = $this->request->getPost('department');
            $employee = $this->request->getPost('employee');
            $type = $this->request->getPost('workflow_type');
            $data = [
                'w_flow_ex_added_by' => $this->session->user_id,
                'w_flow_ex_employee_id' => $employee,
                'w_flow_ex_department_id' => $department,
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
        ];

        return view('pages/workflow/workflow-requests', $data);
    }

    public function createNewWorkflowRequest(){
        $data = [
          'workflow_types'=>$this->workflowtype->getAllWorkflowTypes()
        ];
        return view('pages/workflow/new-request', $data);
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
                    'workflow_types'=>$this->workflowtype->getAllWorkflowTypes()
                ]);
            }else{
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
                return redirect()->back()->with("success", "<strong>Success!</strong> Your request was submitted successfully.");
            }

        }
    }


    public function viewWorkflowRequest($id){
        $request = $this->workflowrequest->getWorkflowRequestDetail($id);

        if(!empty($request)){
            $data = [
              'workflow_request'=>$request,
              'workflow_attachments'=>$this->workflowrequestattachment->getWorkflowRequestAttachments($id)
            ];
            return view('pages/workflow/view-workflow-request', $data);
        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> No record found.");
        }

    }

}
