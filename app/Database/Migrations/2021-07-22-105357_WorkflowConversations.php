<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WorkflowConversations extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'workflow_conversation_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'comment' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'commented_by' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'request_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('workflow_conversation_id', true);
        $this->forge->createTable('workflow_conversations');
	}

	public function down()
	{
		//
	}
}
