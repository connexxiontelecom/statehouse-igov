<?php

namespace App\Models;

use CodeIgniter\Model;

class Employee extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'employees';
	protected $primaryKey           = 'employee_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['employee_id', 'employee_f_name', 'employee_l_name', 'employee_o_name', 'employee_sex', 'employee_dob', 'employee_level', 'employee_step', 'employee_department_id', 'employee_position_id', 'employee_mail', 'employee_phone', 'employee_signature' ];

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

    public function getEmployeeByUserEmployeeId($user_employee_id){
        return Employee::where('employee_id', $user_employee_id)->first();
    }

    public function getAllEmployee(){
        return Employee::findAll();
    }
}
