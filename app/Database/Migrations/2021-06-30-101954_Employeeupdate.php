<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employeeupdate extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$fields = [
			'employee_address' => [
				'after' => 'employee_mail',
				'type' => 'TEXT',
			
			],
		
		];
		$this->forge->addColumn('employees', $fields);
	}

	public function down()
	{
		//
	}
}
