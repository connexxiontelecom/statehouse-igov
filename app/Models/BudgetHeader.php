<?php

namespace App\Models;

use CodeIgniter\Model;

class BudgetHeader extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'budget_headers';
	protected $primaryKey           = 'bh_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['bh_id', 'bh_budget_id', 'bh_title', 'bh_code', 'bh_acc_type', 'bh_project', 'bh_project_status', 'bh_cat', 'bh_office', 'bh_parent', 'bh_amount'];

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
