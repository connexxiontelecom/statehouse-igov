<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkflowRequest extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'workflow_requests';
	protected $primaryKey           = 'workflow_request_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['requested_by', 'requested_type_id', 'request_title', 'request_description', 'amount', 'request_status'];

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
    public function getAuthUserWorkflowRequests($user_id){
        $builder = $this->db->table('workflow_requests as wr');
        $builder->join('users as u', 'u.user_id = wr.requested_by');
        $builder->join('workflow_types wt', 'wt.workflow_type_id = wr.requested_type_id');
        $builder->where('wr.requested_by = '.$user_id);
        $result = $builder->get()->getResultArray();
        return $result;
    }

    public function getWorkflowRequestDetail($request_id){
        $builder = $this->db->table('workflow_requests as wr');
        $builder->join('users as u', 'u.user_id = wr.requested_by');
        $builder->join('workflow_types wt', 'wt.workflow_type_id = wr.requested_type_id');
        $builder->where('wr.workflow_request_id = '.$request_id);
        $result = $builder->get()->getRowObject();
        return $result;
    }
}
