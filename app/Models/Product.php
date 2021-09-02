<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'products';
	protected $primaryKey           = 'product_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['product_id', 'product_name','category_id', 'vendor_id', 'cost_price', 'selling_price','quantity','in_stock', 'added_by'];

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


    public function getAllProducts(){
        $builder = $this->db->table('products as p');
        $builder->join('vendors as v','p.vendor_id = v.vendor_id');
        return $builder->get()->getResultArray();
    }

    public function getProductById($id){
        $builder = $this->db->table('products as p');
        $builder->join('employees as e','e.employee_id = p.added_by' );
        $builder->where('p.product_id = '.$id);
        return $builder->get()->getFirstRow();
    }
}
