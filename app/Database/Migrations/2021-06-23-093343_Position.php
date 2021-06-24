<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Position extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		
		$this->forge->addField(
			[
				'pos_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'pos_name' =>[
					'type' => 'TEXT',
				],
				
				'pos_dpt_id' =>[
					'type' => 'INT',
				],
				
				
				'updated_at' => [
					'type' => 'datetime',
					'null' => true,
				],
				'created_at datetime default current_timestamp',
			
			
			
			
			]
		);
		$this->forge->addKey('pos_id', true);
		$this->forge->createTable('positions');
	}

	public function down()
	{
		//
	}
}
