<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LessonAttachments extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'lesson_attachment_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'lesson_attachment_training_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'lesson_attachment_lesson_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'attachment' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('lesson_attachment_id', true);
        $this->forge->createTable('lesson_attachments');
	}

	public function down()
	{
		//
	}
}
