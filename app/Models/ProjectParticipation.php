<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectParticipation extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'project_participations';
	protected $primaryKey           = 'project_part_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['project_part_id', 'participant_id', 'part_type', 'part_project_id'];

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


    public function getAllProjectParticipants($project_id){
        $builder = $this->db->table('project_participations as pp');
        $builder->join('employees as e','e.employee_id = pp.participant_id' );
        $builder->where('pp.part_project_id = '.$project_id);
        return $builder->get()->getResultObject();
    }
}
