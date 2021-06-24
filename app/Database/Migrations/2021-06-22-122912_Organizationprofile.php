<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Organizationprofile extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		
		$this->forge->addField(
			[
				'org_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'org_name' =>[
					'type' => 'TEXT',
				],
				
				'org_address' =>[
					'type' => 'TEXT',
				],
				
				
				'org_c_phone' =>[
					'type' => 'TEXT',
				],
				
				'org_c_email' =>[
					'type' => 'TEXT',
				],
				
				
				'org_web' =>[
					'type' => 'TEXT',
				],
				
				
				'org_logo' =>[
					'type' => 'TEXT'
				],
				
				
				'updated_at' => [
					'type' => 'datetime',
					'null' => true,
				],
				'created_at datetime default current_timestamp',
			
			
			
			
			]
		);
		$this->forge->addKey('org_id', true);
		$this->forge->createTable('organization');
	}

	public function down()
	{
		//
	}
}
