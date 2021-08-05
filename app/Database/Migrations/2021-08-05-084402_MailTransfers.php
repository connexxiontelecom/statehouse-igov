<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MailTransfers extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'mt_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'mt_mail_id' =>[
					'type' => 'INT',
				],

				'mt_from_id' =>[
					'type' => 'INT',
				],

				'mt_to_id' =>[
					'type' => 'INT',
				],

				'mt_status' =>[
					'type' => 'INT',
				],

				'mt_confirmed_at' => [
					'type' => 'datetime',
					'null' => true,
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('mt_id', true);
		$this->forge->createTable('mail_transfers');
	}

	public function down()
	{
	}
}
