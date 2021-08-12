<?php

namespace App\Models;

use CodeIgniter\Model;

class Project extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'projects';
	protected $primaryKey           = 'project_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['project_id','project_priority','project_status', 'project_description',
        'project_sponsor','project_name','project_manager_id', 'project_start_date', 'project_end_date','project_budget',
        'project_privacy'];


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

    public function getAllProjects(){
        $builder = $this->db->table('projects as p');
        $builder->join('employees as e','e.employee_id = p.project_manager_id' );
        return $builder->get()->getResultArray();
    }

    public function getProjectById($id){
        $builder = $this->db->table('projects as p');
        $builder->join('employees as e','e.employee_id = p.project_manager_id' );
        $builder->where('p.project_id = '.$id);
        return $builder->get()->getFirstRow();
    }
}
