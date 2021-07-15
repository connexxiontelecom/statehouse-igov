<?php

namespace App\Models;

use CodeIgniter\Model;

class Lesson extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'lessons';
	protected $primaryKey           = 'lesson_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['lesson_id', 'lesson_title', 'lesson_description', 'lesson_slug', 'training_id'];

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

    public function getLessonsByTrainingId($id){
        $builder = $this->db->table('lessons');
        $builder->where('training_id', $id);
        $notices = $builder->get()->getResultArray();
        return $notices;
    }
}
