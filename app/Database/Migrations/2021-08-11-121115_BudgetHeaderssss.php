<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BudgetHeaderssss extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$fields = [
			'bh_office' => [
				'type' => 'TEXT',
				
			],
		
		];
		$this->forge->modifyColumn('budget_headers', $fields);
	}

	public function down()
	{
		//
	}
}
