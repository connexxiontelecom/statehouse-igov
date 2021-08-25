<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TaskExecutor extends Migration
{
	public function up()
	{
    $this->db->disableForeignKeyChecks();
    $this->forge->addField(
      [
        'te_id' => [
          'type' => 'INT',
          'constraint' => 11,
          'auto_increment' => true,
        ],

        'te_task_id' =>[
          'type' => 'INT',
        ],

        'te_executor_id' => [
          'type' => 'INT',
        ],

        'te_status' => [
          'type' => 'INT',
        ],

        'created_at datetime default current_timestamp',
      ]
    );
    $this->forge->addKey('te_id', true);
    $this->forge->createTable('task_executors');
	}

	public function down()
	{
		//
	}
}
