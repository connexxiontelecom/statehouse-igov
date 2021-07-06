<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Postupdate extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$fields = [
			'p_department_id' => [
				'name' => 'p_recipients_id',
				'type' => 'TEXT',
			
			],
		
		];
		$this->forge->modifyColumn('posts', $fields);
		
		
		$fields = [
			'p_attachment' => [
				'type' => 'TEXT',
				'after' => 'p_recipients_id'
			],
		
		];
		$this->forge->addColumn('posts', $fields);
	}

	public function down()
	{
		//
	}
}
