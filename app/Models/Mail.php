<?php

namespace App\Models;

use CodeIgniter\Model;

class Mail extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'mails';
	protected $primaryKey           = 'm_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'm_id',
		'm_ref_no',
		'm_file_ref_no',
		'm_subject',
		'm_sender',
		'm_direction',
		'm_date_received',
		'm_date_correspondence',
		'm_status',
		'm_notes',
		'm_by',
		'm_desk',
		'm_registry_id',
    'm_source',
    'm_post_id',
    'm_acknowledgement'
	];

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
}
