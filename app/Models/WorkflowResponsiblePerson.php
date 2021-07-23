<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkflowResponsiblePerson extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'workflow_responsible_people';
	protected $primaryKey           = 'workflow_responsible_people_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['redirected_to_id', 'request_id', 'workflow_responsible_people_id', 'request_status'];

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


	public function getWorkflowResponsiblePersonsByRequestId($request_id){
	    $builder = $this->db->table('workflow_responsible_people as wrp');
	    $builder->join('employees as e', 'e.employee_id = wrp.redirected_to_id');
	    $builder->where('wrp.request_id = '.$request_id);
	    return $builder->get()->getResultArray();
    }

    public function getPublishedResponsiblePersons($request_id){
        return WorkflowResponsiblePerson::where('request_id', $request_id)->findAll();
    }
}
