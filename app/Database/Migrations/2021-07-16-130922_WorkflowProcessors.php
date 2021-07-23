<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WorkflowProcessors extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'workflow_processor_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'w_flow_added_by' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'w_flow_employee_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'w_flow_department_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'w_flow_type_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('workflow_processor_id', true);
        $this->forge->createTable('workflow_processors');
	}

	public function down()
	{
		//
	}
}
