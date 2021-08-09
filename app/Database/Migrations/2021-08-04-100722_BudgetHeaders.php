<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BudgetHeaders extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'bh_id' => [
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'bh_budget_id' => [
					'type' => 'INT',
				],
				
				'bh_title' =>[
					'type' => 'TEXT',
				],
				
				'bh_office' => [
					'type' => 'INT',
				],
				
				'bh_amount' =>[
					'type' => 'DOUBLE'
				],
				
				
				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('bh_id', true);
		$this->forge->createTable('budget_headers');
	}

	public function down()
	{
		//
	}
}
