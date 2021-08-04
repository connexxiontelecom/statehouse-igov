<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BudgetSetups extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'budget_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'budget_title' =>[
					'type' => 'TEXT',
				],
				
				'budget_year' => [
					'type' => 'TEXT',
				],
				
				
				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('budget_id', true);
		$this->forge->createTable('budgets');
	}

	public function down()
	{
		//
	}
}
