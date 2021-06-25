<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		
		$this->forge->addField(
			[
				'user_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'user_name' =>[
					'type' => 'TEXT',
				],
				
				'user_email' =>[
					'type' => 'TEXT',
				],
				
				
				'user_phone' =>[
					'type' => 'TEXT',
				],
				
				'user_username' =>[
					'type' => 'TEXT',
				],
				
				
				'user_password' =>[
					'type' => 'TEXT',
				],
				
				
				'user_employee_id' =>[
					'type' => 'TEXT'
				],
				
				'user_status' =>[
					'type' => 'INT',
				],
				
				'user_type'=>[
					'type' => 'INT',
				],
				
				'updated_at' => [
					'type' => 'datetime',
					'null' => true,
				],
				'created_at datetime default current_timestamp',
			
			
			
			
			]
		);
		$this->forge->addKey('user_id', true);
		$this->forge->createTable('users');
	}

	public function down()
	{
		//
	}
}
