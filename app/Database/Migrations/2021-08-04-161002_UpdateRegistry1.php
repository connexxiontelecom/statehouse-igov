<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateRegistry1 extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$fields = [
			'registry_manager_id' => [
				'type' => 'INT',
			],
		];
		$this->forge->addColumn('registries', $fields);
	}

	public function down()
	{
		//
	}
}
