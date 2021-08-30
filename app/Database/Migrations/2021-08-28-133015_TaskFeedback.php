<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TaskFeedback extends Migration
{
	public function up()
	{
    $this->db->disableForeignKeyChecks();
    $this->forge->addField(
      [
        'tf_id' => [
          'type' => 'INT',
          'constraint' => 11,
          'auto_increment' => true,
        ],

        'tf_task_id' =>[
          'type' => 'INT',
        ],

        'tf_user_id' => [
          'type' => 'INT',
        ],

        'tf_comment' => [
          'type' => 'TEXT',
        ],

        'created_at datetime default current_timestamp',
      ]
    );
    $this->forge->addKey('tf_id', true);
    $this->forge->createTable('task_feedbacks');
	}

	public function down()
	{
		//
	}
}
