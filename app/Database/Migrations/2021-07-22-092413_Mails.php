<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mails extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'm_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'm_ref_no' =>[
					'type' => 'TEXT',
				],

				'm_file_ref_no' => [
					'type' => 'TEXT',
				],

				'm_subject' =>[
					'type' => 'TEXT',
				],

				'm_sender' =>[
					'type' => 'TEXT'
				],

				'm_direction' => [
					'type' => 'INT'
				],

				'm_date_received' =>[
					'type' => 'datetime'
				],

				'm_date_correspondence' =>[
					'type' => 'datetime'
				],

				'm_status' =>[
					'type' => 'INT',
				],

				'updated_at' => [
					'type' => 'datetime',
					'null' => true,
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('m_id', true);
		$this->forge->createTable('mails');
	}

	public function down()
	{
		//
	}
}
