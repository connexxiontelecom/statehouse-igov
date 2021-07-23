<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WorkflowRequestAttachments extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'workflow_request_attachment_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'workflow_request_id' =>[
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
        $this->forge->addKey('workflow_request_attachment_id', true);
        $this->forge->createTable('workflow_request_attachments');
	}

	public function down()
	{
		//
	}
}
