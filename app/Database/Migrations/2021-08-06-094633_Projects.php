<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Projects extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'project_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'project_manager_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'project_name' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'project_sponsor' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'project_description' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'project_status' =>[
                    'type' => 'INT',
                    'null'=>true,
                    'comment'=>'0=pending,1=started,2=in-progress,3=completed,4=cancelled,'
                ],
                'project_priority' =>[
                    'type' => 'INT',
                    'null'=>true,
                    'comment'=>'1=normal,2=medium,3=high'
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('project_id', true);
        $this->forge->createTable('projects');
	}

	public function down()
	{
		//
	}
}
