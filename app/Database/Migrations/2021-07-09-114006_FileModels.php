<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FileModels extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'file_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'folder_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'uploaded_by' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'file_name' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'name' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],

                'size' =>[
                    'type' => 'DOUBLE',
                    'null'=>true,
                ],

                'password' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'slug' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'created_at datetime default current_timestamp',




            ]
        );
        $this->forge->addKey('file_id', true);
        $this->forge->createTable('file_models');
	}

	public function down()
	{
		//
	}
}
