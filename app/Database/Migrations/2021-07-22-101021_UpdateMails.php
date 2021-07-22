<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateMails extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$fields = [
			'm_notes' => [
				'type' => 'TEXT',
			]
		];
		$this->forge->addColumn('mails', $fields);
	}

	public function down()
	{
		//
	}
}
