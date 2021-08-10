<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BudgetCategory extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'bc_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'bc_name' => [
					'type' => 'TEXT',
				],
				
				
				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('bc_id', true);
		$this->forge->createTable('budget_categories');
	
	}

	public function down()
	{
		//
	}
}
