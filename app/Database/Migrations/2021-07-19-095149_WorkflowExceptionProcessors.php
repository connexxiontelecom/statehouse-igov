<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WorkflowExceptionProcessors extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'workflow_ex_processor_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'w_flow_ex_added_by' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'w_flow_ex_employee_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'w_flow_ex_to_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'w_flow_ex_type_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('workflow_ex_processor_id', true);
        $this->forge->createTable('workflow_exception_processors');
	}

	public function down()
	{
		//
	}
}
