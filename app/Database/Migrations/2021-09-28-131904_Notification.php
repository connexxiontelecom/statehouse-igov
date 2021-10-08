<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notification extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'notification_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'subject' =>[
					'type' => 'TEXT',
				],

				'body' =>[
					'type' => 'TEXT',
				],

				'recipient' =>[
					'type' => 'INT',
				],

				'link' =>[
					'type' => 'TEXT',
				],

				'cta' =>[
					'type' => 'TEXT',
				],

				'notification_status' =>[
					'type' => 'INT',
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('notification_id', true);
		$this->forge->createTable('notifications');
	}

	public function down()
	{
		//
	}
}
