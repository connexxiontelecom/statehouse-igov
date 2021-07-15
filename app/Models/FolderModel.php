<?php

namespace App\Models;

use CodeIgniter\Model;

class FolderModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'folder_models';
	protected $primaryKey           = 'folder_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['created_by', 'parent_id', 'folder', 'location', 'password', 'name', 'permission', 'slug', 'visibility'];

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



	/*
	 * Use-case methods
	 */

    public function getAllFolders(){
        return FolderModel::findAll(); //public folders
    }
    public function getAllMyAndPublicFolders($user_id){
        return FolderModel::where('visibility',2)->orWhere('created_by', $user_id)->findAll(); //public folders
    }

    public function getFolderContentById($id){
        $builder = $this->db->table('folder_models');
        $builder->where('parent_id', $id);
        return $builder->get()->getResultArray();
    }

    public function searchFolders($keyword, $user_id){
        $builder = $this->db->table('folder_models');
        $builder->like('folder', $keyword);
        $builder->orWhere('visibility', 2); //public
        $builder->where('created_by', $user_id); //public
        return $builder->get()->getResultArray();
    }
}
