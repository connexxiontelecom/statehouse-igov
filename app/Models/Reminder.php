<?php

namespace App\Models;

use CodeIgniter\Model;

class Reminder extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'reminders';
	protected $primaryKey           = 'reminder_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['reminder_id', 'reminder_employee_id', 'title', 'reminder_start_date', 'reminder_end_date'];

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


    function fetchAllReminders($user_id){
        return Reminder::where('reminder_employee_id',$user_id)->findAll();
    }

/*    function insert_event($data)
    {
        $this->db->insert('events', $data);
    }

    function update_event($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('events', $data);
    }

    function delete_event($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('events');
    }*/
}
