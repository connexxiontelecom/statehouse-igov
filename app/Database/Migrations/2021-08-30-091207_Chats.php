<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Chats extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'chat_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'chat_from_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'chat_to_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'chat_message' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'chat_attachment' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'chat_is_read' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('chat_id', true);
        $this->forge->createTable('chats');
	}

	public function down()
	{
		//
	}
}
