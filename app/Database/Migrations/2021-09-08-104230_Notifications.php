<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notifications extends Migration
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

				'action' =>[
					'type' => 'TEXT',
				],

				'description' =>[
					'type' => 'TEXT',
				],

				'initiator_id' =>[
					'type' => 'INT',
				],

				'target_id' =>[
					'type' => 'INT',
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
