<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MailHolders extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'mh_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'mh_mail_id' =>[
					'type' => 'INT',
				],

				'mh_holder_id' =>[
					'type' => 'INT',
				],

				'mh_status' =>[
					'type' => 'INT',
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('mh_id', true);
		$this->forge->createTable('mail_holders');
	}

	public function down()
	{
		//
	}
}
