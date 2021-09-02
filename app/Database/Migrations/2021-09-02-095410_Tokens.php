<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tokens extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'token_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'token_symbol' =>[
					'type' => 'TEXT',
				],

				'token_user_id' =>[
					'type' => 'INT',
				],

				'token_status' =>[
					'type' => 'INT',
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('token_id', true);
		$this->forge->createTable('tokens');
	}

	public function down()
	{
		//
	}
}
