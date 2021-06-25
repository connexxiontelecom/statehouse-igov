<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Noticeu extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$fields = [
			'n_signed_by' => [
				'after' => 'n_by',
				'type' => 'INT',

			],

		];
		$this->forge->addColumn('notices', $fields);
	}

	public function down()
	{
		//
	}
}
