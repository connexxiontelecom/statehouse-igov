<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FleetRenewal extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'frt_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'frt_name' =>[
					'type' => 'TEXT',
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('frt_id', true);
		$this->forge->createTable('fleet_renewal_types');
	}

	public function down()
	{
		//
	}
}
