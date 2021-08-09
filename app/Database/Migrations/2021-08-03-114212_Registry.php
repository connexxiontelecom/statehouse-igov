<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Registry extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'registry_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'registry_name' =>[
					'type' => 'TEXT',
				],

				'registry_description' => [
					'type' => 'TEXT',
				],

				'registry_status' => [
					'type' => 'INT',
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('registry_id', true);
		$this->forge->createTable('registries');
	}

	public function down()
	{
		//
	}
}
