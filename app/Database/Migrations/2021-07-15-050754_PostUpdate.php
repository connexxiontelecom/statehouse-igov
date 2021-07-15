<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PostUpdate extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$fields = [
			'p_attachment' => [
				'name' => 'p_signature',
				'type' => 'TEXT',
			],
		];
		$this->forge->modifyColumn('posts', $fields);
	}

	public function down()
	{
		//
	}
}
