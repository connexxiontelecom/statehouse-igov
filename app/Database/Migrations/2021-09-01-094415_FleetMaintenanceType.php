<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FleetMaintenanceType extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'fmt_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'fmt_name' =>[
					'type' => 'TEXT',
				],

				'fmt_interval' =>[
					'type' => 'INT',
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('fmt_id', true);
		$this->forge->createTable('fleet_maintenance_types');
	}

	public function down()
	{
		//
	}
}
