<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkflowConversation extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'workflow_conversations';
	protected $primaryKey           = 'workflow_conversation_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['workflow_conversation_id', 'comment', 'commented_by', 'request_id'];

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
    public function getWorkflowConversationByRequestId($id){
        $builder = $this->db->table('workflow_conversations as wc');
        $builder->join('employees as e', 'e.employee_id = wc.commented_by');
        return $builder->get()->getResultArray();
    }
}
