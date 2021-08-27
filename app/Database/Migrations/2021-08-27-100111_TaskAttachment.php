<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TaskAttachment extends Migration
{
	public function up()
	{
    $this->db->disableForeignKeyChecks();
    $this->forge->addField(
      [
        'ta_id' => [
          'type' => 'INT',
          'constraint' => 11,
          'auto_increment' => true,
        ],

        'ta_task_id' =>[
          'type' => 'INT',
        ],

        'ta_uploader_id' => [
          'type' => 'INT',
        ],

        'ta_link' => [
          'type' => 'TEXT',
        ],

        'created_at datetime default current_timestamp',
      ]
    );
    $this->forge->addKey('ta_id', true);
    $this->forge->createTable('task_attachments');
	}

	public function down()
	{
		//
	}
}
