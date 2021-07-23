<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkflowProcessor extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'workflow_processors';
	protected $primaryKey           = 'workflow_processor_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['workflow_processor_id', 'w_flow_added_by', 'w_flow_employee_id', 'w_flow_department_id', 'w_flow_type_id'];

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

	public function getAllProcessors(){
	    $builder = $this->db->table('workflow_processors as wp');
	    $builder->join('departments as d', 'd.dpt_id = wp.w_flow_department_id');
	    $builder->join('workflow_types as wt', 'wt.workflow_type_id = wp.w_flow_type_id');
	    $builder->join('users as u', 'u.user_id = wp.w_flow_employee_id');
        return $builder->get()->getResultArray();
    }
    public function checkNormalList($user_id, $workflow_type, $department){
        return WorkflowProcessor::where('w_flow_employee_id', $user_id)
            ->where('w_flow_type_id', $workflow_type)
            ->where('w_flow_department_id', $department)
            ->first();
    }
    public function checkAllNormalList($user_id, $workflow_type, $department){
        return WorkflowProcessor::where('w_flow_employee_id', $user_id)
            ->where('w_flow_type_id', $workflow_type)
            ->where('w_flow_department_id', $department)
            ->findAll();
    }
}
