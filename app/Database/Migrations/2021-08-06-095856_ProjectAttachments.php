<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectAttachments extends Migration
{
	public function up()
	{

        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'project_attach_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'project_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'project_attachment' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('project_attach_id', true);
        $this->forge->createTable('project_attachments');
	}

	public function down()
	{
		//
	}
}
