<?php

namespace App\Models;

use CodeIgniter\Model;

class Contractor extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'contractors';
	protected $primaryKey           = 'contractor_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['contractor_id','contractor_name','contractor_address','contractor_email',
        'about_contractor','contractor_mobile_no','contractor_website','contractor_added_by'];
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



    public function getAllContractors(){
        $builder = $this->db->table('contractors');
        return $builder->get()->getResultArray();
    }

    public function getContractorById($id){
        $builder = $this->db->table('contractors as c');
        $builder->join('employees as e','e.employee_id = c.added_by' );
        $builder->where('c.contractor_id = '.$id);
        return $builder->get()->getFirstRow();
    }
}
