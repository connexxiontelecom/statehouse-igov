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
	protected $allowedFields        = [];

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


	public function uploadAttachment(){
        $file = $this->request->getFile('file');
        if($file->isValid() && !$file->hasMoved()):
            $file_name = $file->getClientName();
            $file->move('uploads/posts', $file_name);
            echo $file_name;
        endif;
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
}
