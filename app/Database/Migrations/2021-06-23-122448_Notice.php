<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notice extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		
		$this->forge->addField(
			[
				'n_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'n_subject' =>[
					'type' => 'TEXT',
				],
				
				'n_body' =>[
					'type' => 'INT',
				],
				
				'n_status' =>[
					'type' => 'INT',
				],
				
				'n_by' =>[
					'type' => 'INT',
				],
				
				
				'updated_at' => [
					'type' => 'datetime',
					'null' => true,
				],
				'created_at datetime default current_timestamp',
			
			
			
			
			]
		);
		$this->forge->addKey('n_id', true);
		$this->forge->createTable('notices');
	}

	public function down()
	{
		//
	}
}
