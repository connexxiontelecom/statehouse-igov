<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Memo extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		
		$this->forge->addField(
			[
				'm_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'm_subject' =>[
					'type' => 'TEXT',
				],
				
				'm_body' =>[
					'type' => 'INT',
				],
				
				'm_status' =>[
					'type' => 'INT',
				],
				
				'm_by' =>[
					'type' => 'INT',
				],
				
				
				'updated_at' => [
					'type' => 'datetime',
					'null' => true,
				],
				'created_at datetime default current_timestamp',
				'm_date datetime default current_timestamp',
			
			
			
			
			]
		);
		$this->forge->addKey('m_id', true);
		$this->forge->createTable('memos');
	}

	public function down()
	{
		//
	}
}
