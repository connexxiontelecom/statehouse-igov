<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BudgetLog extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField([
			'brl_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => true,
			],
			
			'brl_bh_id' => [
				'type' => 'INT',
			],
			
			'brl_employee_id' => [
				'type' => 'INT',
			],
			
			'brl_amount' => [
				'type' => 'DOUBLE',
			],
			
			'brl_date' => [
				'type' => 'DATETIME',
			],
			
		]);
		$this->forge->addKey('brl_id', true);
		$this->forge->createTable('budget_revision_logs');
	}

	public function down()
	{
		//
	}
}
