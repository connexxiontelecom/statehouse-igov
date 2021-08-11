<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateRegistry2 extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$fields = [
			'registry_users' => [
				'type' => 'TEXT',
			],
		];
		$this->forge->addColumn('registries', $fields);
	}

	public function down()
	{
		//
	}
}
