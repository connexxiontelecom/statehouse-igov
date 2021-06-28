<?php

namespace App\Models;

use CodeIgniter\Model;

class Notice extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'notices';
	protected $primaryKey           = 'n_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['n_id', 'n_subject', 'n_body', 'n_status', 'n_signed_by', 'n_by'];

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

	public function get_notices_ad($paginate){
		$builder = $this->db->table('notices');
		$builder->where('n_status', 2);
		$builder->orWhere('n_status', 3);
		$builder->join('users', 'notices.n_signed_by = users.user_id');
		$notices = $builder->get()->getResultArray();
		$new_notices = array();
		$i = 0;
		foreach ($notices as $notice):
			$builder =  $this->db->table('users');
			$builder->where('user_id', $notice['n_by']);
			$user = $builder->get()->getRowArray();
			$notice['created_by'] = $user['user_name'];
			$new_notices[$i] = $notice;
			$i++;
		endforeach;

		return $new_notices->paginate(5);

	}
}
