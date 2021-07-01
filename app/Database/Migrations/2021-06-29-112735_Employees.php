<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employees extends Migration
{
	public function up()
	{
		['employee_id', 'employee_f_name', 'employee_l_name', 'employee_o_name', 'employee_sex', 'employee_dob', 'employee_level', 'employee_step', 'employee_department_id', 'employee_position_id', 'employee_email', 'employee_phone', 'employee_signature'];
		//
		
		//
		$this->db->disableForeignKeyChecks();
		
		$this->forge->addField(
			[
				'employee_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'employee_f_name' =>[
					'type' => 'TEXT',
				],
				
				
				'employee_l_name' =>[
					'type' => 'TEXT',
				],
				
				
				'employee_o_name' =>[
					'type' => 'TEXT',
					'null' => true,
				],
				
				'employee_sex' =>[
					'type' => 'TEXT',
				],
				
				'employee_dob' =>[
					'type' => 'DATE',
				],
				
				'employee_level' =>[
					'type' => 'TEXT',
				],
				
				'employee_step' =>[
					'type' => 'TEXT',
				],
				
				'employee_department_id' =>[
					'type' => 'INT',
				],
				
				'employee_position_id' =>[
					'type' => 'INT',
				],
				
				'employee_phone' =>[
					'type' => 'TEXT',
				],
				
				'employee_mail' =>[
					'type' => 'TEXT',
				],
				
				'employee_signature' =>[
					'type' => 'TEXT',
				],
				
				'updated_at' => [
					'type' => 'datetime',
					'null' => true,
				],
				
				'employee_date datetime default current_timestamp',
			
			
			
			
			]
		);
		$this->forge->addKey('employee_id', true);
		$this->forge->createTable('employees');
	}

	public function down()
	{
		//
	}
}
