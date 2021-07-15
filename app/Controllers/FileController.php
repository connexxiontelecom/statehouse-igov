<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FileModel;
use App\Models\FolderModel;
use App\Models\SharedFile;
use App\Models\UserModel;

class FileController extends BaseController
{
    public function __construct()
    {
        if (session()->get('type') == 1): //employee
            echo view('auth/access_denied');
            exit;
        endif;

        $this->file = new FileModel();
        $this->folder = new FolderModel();
        $this->user = new UserModel();
        $this->sharedfile = new SharedFile();

    }



    public function index()
	{
	    $data = [
	      'files'=>$this->file->getAllFiles(),
            'folders'=>$this->folder->getAllFolders(),
            'users'=>$this->user->getAllUsers()
        ];
	    return view('pages/gdrive/index', $data);
	}

	public function processAttachmentUploads(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $attachment = $this->request->getFile('attachments');
            //$data = [];
            if ($attachment->isValid()){
                $extension = $attachment->guessExtension();
                $filename = $attachment->getRandomName(); // uniqid() . time() . '.' . $extension;
                $attachment->move('uploads/posts', $filename);
                $data = [
                    'folder_id' => $this->request->getPost('folder'),
                    'uploaded_by' => $this->session->user_id,
                    'file_name' => $filename,
                    'name' => $this->request->getPost('filename'),
                    'size' => $attachment->getSize(),
                    'slug' => substr(sha1(time()), 32, 40),
                ];
                $this->file->save($data);
                return redirect()->to(base_url('/g-drive'))->with('success', 'File uploaded successfully.');
            }else{
                session()->setFlashdata("error", "<strong>Whoops!</strong> Choose a valid file to upload.");
                return redirect()->to( base_url('/g-drive') );
            }
        }


    }

    public function createFolder(){
        if($this->request->getMethod() == 'post'){
            helper(['form', 'url']);
            $rule = [
                'folder_name'=>'required',
                'parent_folder'=>'required',
                'visibility'=>'required'
            ];
            $this->validate($rule);
            $data = [
              'created_by'=>$this->session->user_id,
                'parent_id'=>$this->request->getPost('parent_folder'),
                'folder'=>$this->request->getPost('folder_name'),
                'slug'=>substr(sha1(time()),32,40)
            ];
            $this->folder->save($data);
            return redirect()->to( base_url('/g-drive') )->with('success', 'Folder created successfully.');
        }
    }

    public function openFolder($id){
        $files = $this->file->getFilesByFolderId($id);
        $folders = $this->folder->getFolderContentById($id);
        //if(!empty($files) || !empty($folders)){
            $data = [
                'files'=>$files,
                'folders'=>$folders,
                'folder'=>$id
            ];
            //return print_r($data);
            return view('pages/gdrive/view', $data);
        /*}else{
            return "Hello";
        }*/

    }

    public function removeFile($id){
        if(!empty($this->file->where('file_id', $id)->first())){
            $this->file->where('file_id', $id)->delete();
            return redirect()->to( base_url('/g-drive') )->with('success', 'File deleted successfully.');
        }else{
            return redirect()->to( base_url('/g-drive') )->with('error', 'File could not be deleted.');
        }
    }

    public function shareFileWith(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);

            $data = [
                'file_id'=>$this->request->getPost('file_id'),
                'shared_by'=>$this->session->user_id,
                'shared_with'=>$this->request->getPost('user'),
            ];
            $this->sharedfile->save($data);
            return redirect()->to( base_url('/g-drive') )->with('success', 'File shared successfully.');
        }
    }

    public function shareFileWithMe(){
        $data = [
            'files'=>$this->file->getAllFiles(),
            'users'=>$this->user->getAllUsers()
        ];
        return view('pages/gdrive/shared-with-me', $data);
    }

    public function searchFilesAndFolders($search_params) {
        $notices = $this->notice
            ->where('n_status', 2)
            ->groupStart()
            ->like('n_subject', $search_params)
            ->orLike('n_body', $search_params)
            ->groupEnd()
            ->orderBy('created_at', 'DESC')
            ->paginate('9');
        foreach($notices as $key => $notice) {
            $signed_by = $this->user->find($notice['n_signed_by']);
            $notices[$key]['signed_by'] = $signed_by;
        }
        return $notices;
    }
}
