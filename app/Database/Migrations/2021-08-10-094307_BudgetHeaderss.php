<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BudgetHeaderss extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$fields = [
			'bh_code' => [
				'type' => 'TEXT',
				'after' => 'bh_title'
			],
			
			'bh_acc_type' => [
				'type' => 'INT',
			],
			
			'bh_project' => [
				'type' => 'INT',
			],
			
			'bh_project_status' => [
				'type' => 'INT',
			],
			
			'bh_cat' => [
				'type' => 'INT',
			],
		];
		$this->forge->addColumn('budget_headers', $fields);
	}

	public function down()
	{
		//
	}
}
