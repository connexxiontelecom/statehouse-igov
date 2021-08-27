<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Meetings extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField([
			'meeting_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => true,
			],
			
			'meeting_employees' => [
				'type' => 'TEXT',
			],
			
			'meeting_token' => [
				'type' => 'TEXT',
			],
			
			'meeting_name' =>[
				'type' => 'TEXT'
			],
			
			'meeting_name_strip' => [
				'type' => 'TEXT',
			],
			
			'meeting_start' => [
				'type' => 'DATETIME',
			],
			
			'meeting_end' =>[
				'type' => 'DATETIME'
			]
		
		]);
		$this->forge->addKey('meeting_id', true);
		$this->forge->createTable('meetings');
	}

	public function down()
	{
		//
	}
}
