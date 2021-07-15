<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Verification extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();

		$this->forge->addField(
			[
				'ver_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'ver_user_id' => [
					'type' => 'INT',
				],
				'ver_type' => [
					'type' => 'TEXT',
				],
				'ver_code' => [
					'type' => 'TEXT',
				],
				'ver_status' => [
					'type' => 'TEXT',
				],
				'updated_at' => [
					'type' => 'datetime',
					'null' => true,
				],
				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('ver_id', true);
		$this->forge->createTable('verifications');
	}

	public function down()
	{
		//
	}
}
