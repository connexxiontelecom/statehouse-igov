<?php

namespace App\Models;

use CodeIgniter\Model;

class SharedFile extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'shared_files';
	protected $primaryKey           = 'share_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['share_id', 'shared_by', 'shared_with', 'file_id'];

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
	public function getFilesSharedWithMe($auth_user){
        /*$builder = $this->db->table('file_models as f');
        $builder->join('shared_files as s', 'f.file_id', $id);
        $builder->where('folder_id', $id);
        return $builder->get()->getResultArray();*/
    }
}
