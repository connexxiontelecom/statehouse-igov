<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FileModel;
use App\Models\FolderModel;

class FileController extends BaseController
{
    public function __construct()
    {
       /* if (session()->get('type') == 2):
            echo view('auth/access_denieda');
            exit;
        endif;*/

        $this->file = new FileModel();
        $this->folder = new FolderModel();

    }



    public function index()
	{
	    $data = [
	      'files'=>$this->file->getAllFiles()
        ];
	    return view('pages/gdrive/index', $data);
	}

	public function processAttachmentUploads(){
        if($this->request->getMethod() == 'post'){
            helper(['form', 'url']);
            $attachment = $this->request->getFile('attachments');
            //$data = [];
            if($attachment->isValid())
                $filename = uniqid().time();
                $attachment->move('uploads/posts', $filename);
            $data = [
                'folder_id' =>  0,
                'uploaded_by'  => 1,
                'file_name'  => $filename,
                'name'  => $this->request->getPost('filename'),
                'size'  => $attachment->getSize(),
                'slug'  => substr(sha1(time()),32,40),
            ];
            $this->file->save($data);
                return redirect()->to( base_url('/g-drive') )->with('success', 'File uploaded successfully.');
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
              'created_by'=>1,
                'parent_id'=>$this->request->getPost('parent_folder'),
                'folder'=>$this->request->getPost('folder_name'),
                'slug'=>substr(sha1(time()),32,40)
            ];
            $this->folder->save($data);
            return redirect()->to( base_url('/g-drive') )->with('success', 'Folder created successfully.');
        }
    }
}
