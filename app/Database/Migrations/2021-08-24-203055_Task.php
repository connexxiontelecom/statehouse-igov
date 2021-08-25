<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Task extends Migration
{
	public function up()
	{
    $this->db->disableForeignKeyChecks();
    $this->forge->addField(
      [
        'task_id' => [
          'type' => 'INT',
          'constraint' => 11,
          'auto_increment' => true,
        ],

        'task_subject' =>[
          'type' => 'TEXT',
        ],

        'task_executor' => [
          'type' => 'INT',
        ],

        'task_creator' => [
          'type' => 'INT',
        ],

        'task_priority' => [
          'type' => 'INT',
        ],

        'task_overview' => [
          'type' => 'TEXT',
        ],

        'task_due_date' => [
          'type' => 'datetime',
        ],

        'task_status' => [
          'type' => 'INT',
        ],

        'created_at datetime default current_timestamp',
      ]
    );
    $this->forge->addKey('task_id', true);
    $this->forge->createTable('tasks');
	}

	public function down()
	{
		//
	}
}
