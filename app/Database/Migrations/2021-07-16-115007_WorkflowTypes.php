<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WorkflowTypes extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'workflow_type_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'added_by' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'workflow_type_name' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('workflow_type_id', true);
        $this->forge->createTable('workflow_types');
	}

	public function down()
	{
		//
	}
}
