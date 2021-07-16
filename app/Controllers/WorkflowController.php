<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
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
        $this->workflowtype = new WorkflowType();
    }

	public function settings()
	{
	    $data = [
	      'workflow_types'=>$this->workflowtype->getAllWorkflowTypes()
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
}
