<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AssignmentLogsMi extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'al_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'al_fd_id' =>[
					'type' => 'INT',
				],
				
				'al_employee_id' =>[
					'type' => 'INT',
				],
				
				'al_fv_id' =>[
					'type' => 'INT',
				],
				
				'al_purpose' =>[
					'type' => 'TEXT',
				],
				
				'al_due_date' =>[
					'type' => 'DATE',
				],
				
				'al_by' =>[
					'type' => 'INT',
				],
				
				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('al_id', true);
		$this->forge->createTable('assignment_logs');
	}

	public function down()
	{
		//
	}
}
