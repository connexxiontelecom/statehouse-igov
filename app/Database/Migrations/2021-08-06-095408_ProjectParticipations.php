<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectParticipations extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'project_part_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'participant_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'part_type' =>[
                    'type' => 'INT',
                    'null'=>true,
                    'comment'=>'1=responsible,2=participant,3=observer'
                ],
                'created_at datetime default current_timestamp',
		            'part_project_id' => [
		                'type' => 'INT',
		                'null'=>true,
		            ],
            ]
        );
        $this->forge->addKey('project_part_id', true);
        $this->forge->createTable('project_participations');
	}

	public function down()
	{
		//
	}
}
