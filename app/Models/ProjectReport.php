<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectReport extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'project_reports';
	protected $primaryKey           = 'project_report_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['project_report_id', 'project_report_project_id','project_report_submitted_by',
        'project_report_subject','project_report_content'];
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


    public function getProjectReportsByProjectId($id){
        $builder = $this->db->table('project_reports as pr');
        $builder->where('pr.project_report_project_id = '.$id);
        $builder->orderBy('pr.project_report_id', 'DESC');
        return $builder->get()->getResultObject();
    }
}
