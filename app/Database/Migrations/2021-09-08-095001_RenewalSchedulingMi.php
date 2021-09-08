<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RenewalSchedulingMi extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'rs_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'rs_frt_id' =>[
					'type' => 'INT',
				],
				
				'rs_fv_id' =>[
					'type' => 'INT',
				],
				
				'rs_employee_id' =>[
					'type' => 'INT',
				],
				
				'rs_renew_date' =>[
					'type' => 'DATE',
				],
				
				'rs_due_date' =>[
					'type' => 'DATE',
				],
				
				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('rs_id', true);
		$this->forge->createTable('renewal_schedules');
	}

	public function down()
	{
		//
	}
}
