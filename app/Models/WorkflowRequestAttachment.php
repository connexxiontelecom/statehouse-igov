<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkflowRequestAttachment extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'workflow_request_attachments';
	protected $primaryKey           = 'workflow_request_attachment_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['workflow_request_attachment_id', 'workflow_request_id', 'attachment'];

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


    public function getWorkflowRequestAttachments($request_id){
        $builder = $this->db->table('workflow_request_attachments as wra');
        $builder->where('wra.workflow_request_id = '.$request_id);
        $result = $builder->get()->getResultArray();
        return $result;
    }
}
