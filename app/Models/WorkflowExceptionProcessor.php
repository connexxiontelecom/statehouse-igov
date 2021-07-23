<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkflowExceptionProcessor extends Model
{

	protected $DBGroup              = 'default';
	protected $table                = 'workflow_exception_processors';
	protected $primaryKey           = 'workflow_ex_processor_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['workflow_ex_processor_id', 'w_flow_ex_added_by', 'w_flow_ex_type_id',
        'w_flow_ex_to_id', 'w_flow_ex_employee_id'];

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


    public function getAllExceptionProcessors(){
        $builder = $this->db->table('workflow_exception_processors as we');
        //$builder->join('departments as d', 'd.dpt_id = we.w_flow_ex_department_id');
        $builder->join('workflow_types as wt', 'wt.workflow_type_id = we.w_flow_ex_type_id');
        $builder->join('users as u', 'u.user_id = we.w_flow_ex_employee_id');
        return $builder->get()->getResultArray();
    }

    public function getToUserProcessor($user_id){
        $builder = $this->db->table('users');
        $builder->where('users.user_id = '.$user_id);
        return $builder->get()->getRowObject();
    }

    public function checkExceptionList($user_id, $workflow_type){
        return WorkflowExceptionProcessor::where('w_flow_ex_employee_id', $user_id)->where('w_flow_ex_type_id', $workflow_type)->first();
    }
    public function checkAllExceptionList($user_id, $workflow_type){
        return WorkflowExceptionProcessor::where('w_flow_ex_employee_id', $user_id)
            ->where('w_flow_ex_type_id', $workflow_type)
            ->findAll();
    }
}
