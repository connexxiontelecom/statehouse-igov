<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectConversations extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'project_conversation_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'project_convo_participant_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'project_convo' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('project_conversation_id', true);
        $this->forge->createTable('project_conversations');
	}

	public function down()
	{
		//
	}
}
