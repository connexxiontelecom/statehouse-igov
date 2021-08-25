<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjectContractorsTable extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'project_con_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'project_con_contractor_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'project_con_project_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('project_con_id', true);
        $this->forge->createTable('project_contractors');
	}

	public function down()
	{
		//
	}
}
