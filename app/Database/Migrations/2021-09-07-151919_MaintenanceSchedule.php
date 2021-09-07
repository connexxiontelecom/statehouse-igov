<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MaintenanceSchedule extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'ms_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'ms_fmt_id' =>[
					'type' => 'INT',
				],
				
				'ms_fv_id' =>[
					'type' => 'INT',
				],
				
				'ms_employee_id' =>[
					'type' => 'INT',
				],
				
				'ms_schedule_date' =>[
					'type' => 'DATE',
				],
				
				'ms_schedule_due_date' =>[
					'type' => 'DATE',
				],
				
				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('ms_id', true);
		$this->forge->createTable('maintenance_schedules');
	}

	public function down()
	{
		//
	}
}
