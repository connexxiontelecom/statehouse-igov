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
				'p_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'p_ref_no' =>[
					'type' => 'TEXT',
				],
				
				'p_subject' =>[
					'type' => 'TEXT',
				],
				
				'p_type' =>[
					'type' => 'TEXT'
				],
				
				'p_body' =>[
					'type' => 'TEXT',
				],
				
				'p_status' =>[
					'type' => 'INT',
				],
				
				'p_by' =>[
					'type' => 'INT',
				],
				
				'p_signed_by' =>[
					'type' => 'TEXT',
				],
				
				'p_direction' =>[
					'type' => 'INT'
				],
				
				'p_department_id' =>[
					'type' => 'TEXT'
				],
				
				'updated_at' => [
					'type' => 'datetime',
					'null' => true,
				],
				
				'p_date datetime default current_timestamp',
			
			
			
			
			]
		);
		$this->forge->addKey('p_id', true);
		$this->forge->createTable('posts');
	}

	public function down()
	{
		//
	}
}
