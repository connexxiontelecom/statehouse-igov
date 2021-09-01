<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FleetVehicles extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'fv_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'fv_color' =>[
					'type' => 'TEXT',
				],

				'fv_brand' =>[
					'type' => 'TEXT',
				],

				'fv_engine_type' =>[
					'type' => 'TEXT',
				],

				'fv_mileage' =>[
					'type' => 'TEXT',
				],

				'fv_plate_no' =>[
					'type' => 'TEXT',
				],

				'fv_chassis_no' =>[
					'type' => 'TEXT',
				],

				'fv_fvt_id' =>[
					'type' => 'INT',
				],

				'fv_maker' =>[
					'type' => 'TEXT',
				],

				'fv_purchase_price' =>[
					'type' => 'TEXT',
				],

				'fv_year' =>[
					'type' => 'TEXT',
				],

				'fv_policy_no' =>[
					'type' => 'TEXT',
				],

				'fv_purchase_date' =>[
					'type' => 'datetime',
				],

				'fv_tank_capacity' =>[
					'type' => 'TEXT',
				],

				'fv_vehicle_image' =>[
					'type' => 'TEXT',
				],

				'fv_status' =>[
					'type' => 'INT',
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('fv_id', true);
		$this->forge->createTable('fleet_vehicles');
	}

	public function down()
	{
		//
	}
}
