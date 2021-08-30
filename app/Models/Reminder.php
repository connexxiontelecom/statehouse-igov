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


    function fetchAllMyReminders($user_id){
        $builder = $this->db->table('reminders');
        $builder->select('title');
        $builder->select('reminder_start_date as start');
        $builder->select('reminder_end_date as end');
        $builder->where('reminder_employee_id',$user_id);
        return $builder->get()->getResultArray();
    }

    function fetchAllReminders(){
        $builder = $this->db->table('reminders');
        $builder->select('title');
        $builder->select('reminder_start_date as start');
        $builder->select('reminder_end_date as end');
        return $builder->get()->getResultArray();
    }

    function get24HoursReminders(){
        $reminders = $this->fetchAllReminders();
        foreach($reminders as $reminder){
            $diff = round(abs(strtotime($reminder['end']) - strtotime(date('Y-m-d H:i:s')) ))/86400;
            if( $diff > 1){
                #Send reminder
                return "send mail";
            }
        }
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
