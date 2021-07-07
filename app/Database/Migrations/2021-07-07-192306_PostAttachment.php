<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PostAttachment extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		
		$this->forge->addField(
			[
				'pa_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'pa_post_id' =>[
					'type' => 'INT',
				],
				
				'pa_link' =>[
					'type' => 'TEXT',
				],
				
				'updated_at' => [
					'type' => 'datetime',
					'null' => true,
				],
				
				'p_date datetime default current_timestamp',
			
			
			
			
			]
		);
		$this->forge->addKey('pa_id', true);
		$this->forge->createTable('post_attachments');
	}

	public function down()
	{
		//
	}
}
