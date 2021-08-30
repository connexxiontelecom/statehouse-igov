<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TaskLog extends Migration
{
	public function up()
	{
    $this->db->disableForeignKeyChecks();
    $this->forge->addField(
      [
        'tl_id' => [
          'type' => 'INT',
          'constraint' => 11,
          'auto_increment' => true,
        ],

        'tl_task_id' =>[
          'type' => 'INT',
        ],

        'tl_user_id' => [
          'type' => 'INT',
        ],

        'tl_action' => [
          'type' => 'TEXT',
        ],

        'tl_details' => [
          'type' => 'TEXT',
        ],

        'created_at datetime default current_timestamp',
      ]
    );
    $this->forge->addKey('tl_id', true);
    $this->forge->createTable('task_logs');
	}

	public function down()
	{
		//
	}
}
