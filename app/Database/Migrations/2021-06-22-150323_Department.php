<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Department extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		
		$this->forge->addField(
			[
				'dpt_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'dpt_name' =>[
					'type' => 'TEXT',
				],
				
				
				
				'updated_at' => [
					'type' => 'datetime',
					'null' => true,
				],
				'created_at datetime default current_timestamp',
			
			
			
			
			]
		);
		$this->forge->addKey('dpt_id', true);
		$this->forge->createTable('departments');
	}

	public function down()
	{
		//
	}
}
