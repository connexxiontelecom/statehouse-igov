<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateMails2 extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$fields = [
			'm_desk' => [
				'type' => 'INT',
			],

			'm_registry_id' => [
				'type' => 'INT',
			],
		];
		$this->forge->addColumn('mails', $fields);
	}

	public function down()
	{
		//
	}
}
