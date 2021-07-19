<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WorkflowRequests extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'workflow_request_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'requested_by' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'requested_type_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'request_title' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'request_description' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'amount' =>[
                    'type' => 'DOUBLE',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('workflow_request_id', true);
        $this->forge->createTable('workflow_requests');
	}

	public function down()
	{
		//
	}
}
