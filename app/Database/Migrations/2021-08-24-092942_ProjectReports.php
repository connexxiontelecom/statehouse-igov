<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectReports extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'project_report_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'project_report_project_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'project_report_submitted_by' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'project_report_subject' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'project_report_content' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('project_report_id', true);
        $this->forge->createTable('project_reports');
	}

	public function down()
	{
		//
	}
}
