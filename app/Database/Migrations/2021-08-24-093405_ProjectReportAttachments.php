<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectReportAttachments extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'project_report_attachment_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'project_report_attachment_project_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'project_report_attachment_report_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'project_report_attachment' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('project_report_attachment_id', true);
        $this->forge->createTable('project_report_attachments');
	}

	public function down()
	{
		//
	}
}
