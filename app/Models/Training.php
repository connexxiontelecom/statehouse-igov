<?php

namespace App\Models;

use CodeIgniter\Model;

class Training extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'trainings';
	protected $primaryKey           = 'training_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['training_id', 'title', 'author', 'description','slug'];

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
    public function getTrainings(){
        return Training::findAll(); //orderBy('training_id', 'DESC')->get();
    }

    public function getTrainingBySlug($slug){
        $builder = $this->db->table('trainings');
        $builder->where('slug', $slug);
        $notices = $builder->get()->getResultArray();
        return $notices;
    }
}
