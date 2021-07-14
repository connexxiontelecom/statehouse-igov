<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lessons extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'lesson_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'training_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'lesson_title' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'lesson_description' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'lesson_slug' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('lesson_id', true);
        $this->forge->createTable('lessons');
	}

	public function down()
	{
		//
	}
}
