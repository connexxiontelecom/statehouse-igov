<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BudgetHeadersss extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$fields = [
			'bh_parent' => [
				'type' => 'TEXT',
				'after' => 'bh_acc_type'
			],
			
					];
		$this->forge->addColumn('budget_headers', $fields);
	}

	public function down()
	{
		//
	}
}
