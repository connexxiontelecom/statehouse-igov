<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectConversation extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'project_conversations';
	protected $primaryKey           = 'project_conversation_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['project_conversation_id', 'project_convo_participant_id', 'project_convo', 'project_convo_project_id'];

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

    public function getProjectConversationByProjectId($id){
        $builder = $this->db->table('project_conversations as pc');
        $builder->join('employees as e','e.employee_id = pc.project_convo_participant_id' );
        $builder->where('pc.project_convo_project_id = '.$id);
        return $builder->get()->getResultObject();
    }
}
