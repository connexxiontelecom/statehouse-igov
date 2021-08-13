<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Employee;
use App\Models\Project;
use App\Models\ProjectAttachment;
use App\Models\ProjectConversation;
use App\Models\ProjectParticipation;
use App\Models\UserModel;

class ProjectController extends BaseController
{
    public function __construct()
    {
        if (session()->get('type') == 1): //employee
            echo view('auth/access_denied');
            exit;
        endif;
        $this->user = new UserModel();
        $this->employee = new Employee();
        $this->project = new Project();
        $this->projectparticipant = new ProjectParticipation();
        $this->projectattachment = new ProjectAttachment();
        $this->projectconversation = new ProjectConversation();

    }
	public function index()
	{
	    $data = [
	      'firstTime'=>$this->session->firstTime,
          'username'=>$this->session->username,
          'projects'=>$this->project->getAllProjects()
        ];
		return view('pages/project/index',$data);
	}

	public function showAddNewProjectForm(){
        $data = [
          'firstTime'=>$this->session->firstTime,
          'username'=>$this->session->username,
          'employees'=>$this->employee->getAllEmployee(),
        ];
        return view('pages/project/create',$data);
    }


    public function setNewProject(){
        $inputs = $this->validate([
            'project_name' => ['rules'=> 'required', 'label'=>'Project Name','errors' => [
                'required' => 'Enter a name for this project']],
            'sponsor' => ['rules'=> 'required', 'errors'=>['required'=>'Enter sponsor name']],
            'project_manager' => ['rules'=> 'required', 'errors'=>['required'=>'Select project manager from the list']],
            'priority' => ['rules'=>'required', 'errors'=>['Select project priority']],
            'privacy' => ['rules'=> 'required','errors'=>['required'=>'Choose project privacy']],
            'budget' => ['rules'=> 'required', 'errors'=>['required'=>'Enter project budget']],
            'start_date' => ['rules'=> 'required','errors'=>['required'=>'Choose project start date']],
            'end_date' => ['rules'=> 'required','errors'=>['required'=>'Choose project end date']],
            'project_overview' => ['rules'=> 'required','errors'=>['required'=>'Enter project overview']]
        ]);
        if (!$inputs) {
            return view('pages/project/create', [
                'validation' => $this->validator,
                'firstTime'=>$this->session->firstTime,
                'username'=>$this->session->username,
                'employees'=>$this->employee->getAllEmployee(),
            ]);
        }else{
            $project_name = $this->request->getPost('project_name');
            $sponsor = $this->request->getPost('sponsor');
            $project_manager = $this->request->getPost('project_manager');
            $priority = $this->request->getPost('priority');
            $privacy = $this->request->getPost('privacy');
            $budget = $this->request->getPost('budget');
            $start_date = $this->request->getPost('start_date');
            $due_date = $this->request->getPost('end_date');
            $project_overview = $this->request->getPost('project_overview');
            $data = [
                'project_name'=>$project_name,
                'project_manager_id'=>$project_manager,
                'project_sponsor'=>$sponsor,
                'project_description'=>$project_overview,
                'project_priority'=>$priority,
                'project_privacy'=>$privacy,
                'project_start_date'=>$start_date,
                'project_end_date'=>$due_date,
                'project_budget'=>$budget,
                'project_status'=>0
            ];
            $project = $this->project->insert($data);
            if(!empty($this->request->getPost('team_members'))) {
                foreach ($this->request->getPost('team_members') as $participant){
                    $part = [
                        'participant_id' => $participant,
                        'part_type'=>1,
                        'part_project_id'=>$project,
                    ];
                    $this->projectparticipant->save($part);
                }
            }
            if($this->request->getFileMultiple('attachments')){
                foreach ($this->request->getFileMultiple('attachments') as $attachment){
                    if($attachment->isValid() ){
                        $extension = $attachment->guessExtension();
                        $filename = $attachment->getRandomName();
                        $attachment->move('uploads/posts', $filename);
                        $project_attachment = [
                            'project_id' => $project,
                            'project_attachment' => $filename
                        ];
                        $this->projectattachment->save($project_attachment);
                    }
                }
            }
            return redirect()->back()->with("success", "<strong>Success!</strong> Your project was published.");
        }

    }

    public function viewProject($id){
        $project = $this->project->getProjectById($id);
        if(!empty($project)){
            $data = [
                'project'=>$project,
                'firstTime'=>$this->session->firstTime,
                'username'=>$this->session->username,
                'participants'=>$this->projectparticipant->getAllProjectParticipants($id),
                'attachments'=>$this->projectattachment->getAllProjectAttachmentsByProjectId($id),
                'conversations'=>$this->projectconversation->getProjectConversationByProjectId($id)
            ];
            return view('pages/project/view', $data);
        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> No record found");
        }
    }

    public function setNewConversation(){
        $inputs = $this->validate([
            'comment' => ['rules'=> 'required', 'label'=>'Comment','errors' => [
                'required' => 'Leave a comment']]
        ]);
        if (!$inputs) {
            return redirect()->back()->with("error", "<strong>Whoops!</strong> ");
        }else{
            $data = [
                'project_convo_participant_id'=>$this->session->user_employee_id,
                'project_convo'=>$this->request->getPost('comment'),
                'project_convo_project_id'=>$this->request->getPost('convo_project_id')
            ];
            $this->projectconversation->save($data);
            return redirect()->back()->with("success", "<strong>Success!</strong> Comment registered");
        }
    }
}
