<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FleetVehicleType extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'fvt_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'fvt_name' =>[
					'type' => 'TEXT',
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('fvt_id', true);
		$this->forge->createTable('fleet_vehicle_types');
	}

	public function down()
	{
		//
	}
}
