<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectReportAttachment extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'project_report_attachments';
	protected $primaryKey           = 'project_report_attachment_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['project_report_attachment_id','project_report_attachment_report_id','project_report_attachment_project_id','project_report_attachment'];
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

    public function getProjectReportAttachmentsByProjectId($id){
        $builder = $this->db->table('project_report_attachments as pra');
        $builder->where('pra.project_report_attachment_project_id = '.$id);
        //$builder->where('pra.project_report_attachment_report_id = '.$report_id);
        return $builder->get()->getResultObject();
    }
}
