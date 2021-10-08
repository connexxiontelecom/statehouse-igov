<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Stamps extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'stamp_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'stamp_type' =>[
					'type' => 'TEXT',
				],

				'stamp_status' =>[
					'type' => 'INT',
				],

				'stamp_users' =>[
					'type' => 'TEXT',
				],

				'stamp_image' =>[
					'type' => 'TEXT',
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('stamp_id', true);
		$this->forge->createTable('stamps');
	}

	public function down()
	{
		//
	}
}
