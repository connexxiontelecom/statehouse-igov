<?php

namespace App\Models;

use CodeIgniter\Model;

class LessonAttachment extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'lesson_attachments';
	protected $primaryKey           = 'lesson_attachment_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['lesson_attachment_id', 'lesson_attachment_lesson_id', 'lesson_attachment_training_id', 'attachment'];

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
    public function getTrainingAttachmentsByTrainingId($id){
        $builder = $this->db->table('lesson_attachments');
        $builder->where('lesson_attachment_training_id', $id);
        $attachments = $builder->get()->getResultArray();
        return $attachments;
    }
}
