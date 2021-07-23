<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MailAttachment extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'ma_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'ma_mail_id' =>[
					'type' => 'INT',
				],

				'ma_link' => [
					'type' => 'TEXT',
				],

				'updated_at' => [
					'type' => 'datetime',
					'null' => true,
				],

				'created_at datetime default current_timestamp',
			]
		);
		$this->forge->addKey('ma_id', true);
		$this->forge->createTable('mail_attachments');
	}

	public function down()
	{
		//
	}
}
