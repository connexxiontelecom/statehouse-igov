<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MailFilings extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'mf_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'mf_mail_id' =>[
					'type' => 'INT',
				],

				'mf_filed_by_id' =>[
					'type' => 'INT',
				],

				'mf_file_ref_no' =>[
					'type' => 'TEXT',
				],

				'mf_status' =>[
					'type' => 'INT',
				],

				'mf_confirmed_at' => [
					'type' => 'datetime',
					'null' => true,
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('mf_id', true);
		$this->forge->createTable('mail_filings');
	}

	public function down()
	{
		//
	}
}
