<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Lesson;
use App\Models\LessonAttachment;
use App\Models\Training;
use App\Models\UserModel;

class TrainingController extends BaseController
{
    public function __construct()
    {
        if (session()->get('type') == 1): //employee
            echo view('auth/access_denied');
            exit;
        endif;
        $this->user = new UserModel();
        $this->training = new Training();
        $this->lesson = new Lesson();
        $this->lessonattachment = new LessonAttachment();

    }
	public function index()
	{
	    $data = [
	      'trainings'=>$this->training->getTrainings(),
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username
        ];

		return view('pages/training/index', $data);
	}

	public function showAddNewTrainingForm(){
        $data = [
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username
        ];
        return view('pages/training/create',$data);
    }

    public function showEditTrainingForm($slug){
        $training = $this->training->getTrainingBySlug($slug);
        if(!empty($training)){
            $data = [
                'training'=>$training,
                'firstTime'=>$this->session->firstTime,
                'username'=>$this->session->username
            ];
            return view('pages/training/edit', $data);
        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> Record not found.");
        }
    }

    public function storeNewTraining(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $title = $this->request->getPost('title');
            $description = $this->request->getPost('description');
            if(isset($title) && isset($description)){
                $data = [
                  'title'=>$title,
                  'description'=>$description,
                  'author'=>$this->session->user_id,
                  'slug'=>substr(sha1(time()),23,40)
                ];
                $training_id = $this->training->insert($data);
                $this->send_notification('New Training Created', 'You created a new training', $this->session->user_id, site_url('/trainings/').$training_id, 'click to view training');
                $users = $this->user->findAll();
                foreach ($users as $user) {
	                $this->send_notification('New Training Created', 'A new training was created', $user['user_id'], site_url('/trainings/').$training_id, 'click to view training');
                }
	            return redirect()->to(base_url('/add-new-training'))->with("success", "<strong>Training registered successfully.");
            }else{
                return redirect()->to(base_url('/add-new-training'))->with("error", "<strong>Whoops!</strong> All fields are required.");
            }
        }

    }
    public function updateTraining(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $title = $this->request->getPost('title');
            $description = $this->request->getPost('description');
            if(isset($title) && isset($description)){
                $data = [
                  'title'=>$title,
                  'description'=>$description,
                  'author'=>$this->session->user_id,
                  'slug'=>substr(sha1(time()),23,40)
                ];
                $this->training->update($this->request->getPost('training'),$data);
                return redirect()->to(base_url('/trainings'))->with("success", "<strong>Your changes were saved successfully.");
            }else{
                return redirect()->to(base_url('/add-new-training'))->with("error", "<strong>Whoops!</strong> All fields are required.");
            }
        }

    }

    public function viewTraining($slug){
        $training = $this->training->where('slug', $slug)->first();
        if(!empty($training)){
            $lessons = $this->lesson->getLessonsByTrainingId($training['training_id']);
            $data = [
                'training'=>$training,
                'lessons'=> $lessons,
                'firstTime'=>$this->session->firstTime,
                'username'=>$this->session->username,
                'lesson_attachments'=>$this->lessonattachment->getTrainingAttachmentsByTrainingId($training['training_id'])
            ];
            return view('pages/training/view',$data);
        }else{
            return redirect()->to(base_url('/trainings'))->with("error", "<strong>Whoops!</strong> Record not found.");
        }
    }

    public function addNewTrainingLesson(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $lesson_title = $this->request->getPost('lesson_title');
            $lesson_description = $this->request->getPost('lesson_description');
            if(isset($lesson_title) && isset($lesson_description)){
                $data = [
                    'lesson_title'=>$lesson_title,
                    'lesson_description'=>$lesson_description,
                    'training_id'=>$this->request->getPost('training'),
                    'lesson_slug'=>substr(sha1(time()),23,40)
                ];
                #Lesson attachments
                //$attachments = $this->request->getFileMultiple('attachments');
                $lesson_id =  $this->lesson->insert($data);
		            $this->send_notification('New Lesson Added', 'You added a new lesson to a training', $this->session->user_id, site_url('/trainings/').$this->request->getPost('training'), 'click to view training');
		            $users = $this->user->findAll();
		            foreach ($users as $user) {
			            $this->send_notification('New Lesson Added', 'A lesson was added to a training', $user['user_id'], site_url('/trainings/').$this->request->getPost('training'), 'click to view training');
		            }
                if($this->request->getFileMultiple('attachments')){
                    foreach ($this->request->getFileMultiple('attachments') as $attachment){
                        if($attachment->isValid() ){
                            $extension = $attachment->guessExtension();
                            $filename = $attachment->getRandomName();
                            $attachment->move('uploads/posts', $filename);
                            $lesson_attachment = [
                                'lesson_attachment_training_id' => $this->request->getPost('training'),
                                'lesson_attachment_lesson_id' => $lesson_id,
                                'attachment' => $filename
                            ];
                            $this->lessonattachment->save($lesson_attachment);
                        }
                    }
                }

                return redirect()->back()->with("success", "<strong>Success!</strong> New lesson added.");
            }else{
                return redirect()->to(base_url('/add-new-training'))->with("error", "<strong>Whoops!</strong> All fields are required.");
            }
        }
    }

    public function updateTrainingLesson(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $lesson_title = $this->request->getPost('lesson_title');
            $lesson_description = $this->request->getPost('lesson_description');
            if(isset($lesson_title) && isset($lesson_description)){
                $data = [
                    'lesson_title'=>$lesson_title,
                    'lesson_description'=>$lesson_description,
                    'training_id'=>$this->request->getPost('training'),
                    //'lesson_slug'=>substr(sha1(time()),23,40)
                ];
                #Lesson attachments
                /*if($this->request->getFileMultiple('attachments')){
                    foreach ($this->request->getFileMultiple('attachments') as $attachment){
                        if($attachment->isValid() ){
                            $extension = $attachment->guessExtension();
                            $filename = $attachment->getRandomName();
                            $attachment->move('uploads/posts', $filename);
                            $lesson_attachment = [
                                'lesson_attachment_training_id' => $this->request->getPost('training'),
                                'lesson_attachment_lesson_id' => 1,
                                'attachment' => $filename
                            ];
                            $this->lessonattachment->save($lesson_attachment);
                        }
                    }
                }*/
                $this->lesson->update($this->request->getPost('lesson'), $data);
                return redirect()->back()->with("success", "<strong>Success!</strong> Changes saved.");
            }else{
                return redirect()->to(base_url('/add-new-training'))->with("error", "<strong>Whoops!</strong> All fields are required.");
            }
        }
    }
    public function deleteAttachment($id){
        if(!empty($this->lessonattachment->where('lesson_attachment_id', $id)->first())){
            $this->lessonattachment->where('lesson_attachment_id', $id)->delete();
            return redirect()->back( )->with('success', 'Attachment deleted successfully.');
        }else{
            return redirect()->back()->with('error', 'Attachment could not be deleted.');
        }
    }
}
