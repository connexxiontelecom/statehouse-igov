<?php

namespace App\Models;

use CodeIgniter\Model;

class Vendor extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'vendors';
	protected $primaryKey           = 'vendor_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['vendor_id','vendor_name','vendor_address','vendor_email','about_vendor',
        'vendor_mobile_no','vendor_website','vendor_added_by'];


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

    public function getAllVendors(){
        $builder = $this->db->table('vendors');
        return $builder->get()->getResultArray();
    }

    public function getVendorById($id){
        $builder = $this->db->table('vendors as v');
        $builder->join('employees as e','e.employee_id = v.added_by' );
        $builder->where('v.vendor_id = '.$id);
        return $builder->get()->getFirstRow();
    }
}
