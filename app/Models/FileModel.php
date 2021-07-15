<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'file_models';
	protected $primaryKey           = 'file_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['file_id', 'folder_id', 'uploaded_by', 'file_name', 'name', 'size', 'password', 'slug', 'created_at'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];




	public function getAllFiles(){
	    return FileModel::findAll();
    }
    public function getAllMyFiles($user_id){
	    return FileModel::where('uploaded_by', $user_id)->findAll();
    }

    public function getFileById($id){

    }

    public function getFileBySlug($slug){

    }


	public function uploadAttachment(){
        //$file = $this->request->getFile('file');
        foreach($this->request->getFile('attachments') as $attach){
            if($attach->isValid() && !$attach->hasMoved()):
                $file_name = $attach->getClientName();
                $attach->move('uploads/posts', $file_name);

            endif;
        }

    }

    public function deleteAttachment(){
        $file = $this->request->getPostGet('files');
        $directory = 'uploads/posts/'.$file;
        if(unlink($directory)):
            $response['message'] = 'Deleted Successful';
        else:
            $response['message'] = 'An error Occurred';
        endif;
        return $this->response->setJSON($response);
    }

    public function getFilesByFolderId($id){
        $builder = $this->db->table('file_models');
        $builder->where('folder_id', $id);
        return $builder->get()->getResultArray();
    }
    public function getFileByFileId($id){
        $builder = $this->db->table('file_models');
        $builder->where('file_id', $id);
        return $builder->first();
    }

    public function searchFiles($keyword, $user_id){
        $builder = $this->db->table('file_models');
        $builder->like('name', $keyword);
        $builder->where('uploaded_by', $user_id); //public
        return $builder->get()->getResultArray();
    }
    public function sharedWithMe($user_id){
        $builder = $this->db->table('file_models as f');
        $builder->join('shared_files as s','s.file_id = f.file_id' );
        $builder->where('s.shared_with', $user_id);
        return $builder->get()->getResultArray();
    }

}
