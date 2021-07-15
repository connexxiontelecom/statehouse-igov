<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Trainings extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'training_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'author' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'title' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'description' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'slug' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('training_id', true);
        $this->forge->createTable('trainings');
	}

	public function down()
	{
		//
	}
}
