<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BudgetSetupss extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$fields = [
			'budget_status' => [
				'type' => 'TEXT',
				'after' => 'budget_year'
			],
			
		];
		$this->forge->addColumn('budgets', $fields);
	}

	public function down()
	{
		//
	}
}
