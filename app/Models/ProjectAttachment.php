<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectAttachment extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'project_attachments';
	protected $primaryKey           = 'project_attach_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['project_attach_id','project_id','project_attachment'];
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

    public function getAllProjectAttachmentsByProjectId($project_id){
        $builder = $this->db->table('project_attachments');
        $builder->where('project_id = '.$project_id);
        return $builder->get()->getResultObject();
    }
}
