<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WorkflowResponsiblePersons extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'workflow_responsible_people_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'redirected_to_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'request_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'request_status' =>[
                    'type' => 'INT',
                    'null'=>true,
                    'default'=>0,
                    'comment'=>'0=pending, 1=approved, 2=Declined'
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('workflow_responsible_people_id', true);
        $this->forge->createTable('workflow_responsible_people');
	}

	public function down()
	{
		//
	}
}
