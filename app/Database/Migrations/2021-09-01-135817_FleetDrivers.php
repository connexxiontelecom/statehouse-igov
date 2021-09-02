<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FleetDrivers extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'fd_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'fd_user_id' =>[
					'type' => 'INT',
				],

				'fd_moi' =>[
					'type' => 'INT',
				],

				'fd_moi_expiry' =>[
					'type' => 'datetime',
				],

				'fd_moi_attachment' =>[
					'type' => 'TEXT',
				],

				'fd_status' =>[
					'type' => 'INT',
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('fd_id', true);
		$this->forge->createTable('fleet_drivers');
	}

	public function down()
	{
		//
	}
}
