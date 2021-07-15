<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FolderModels extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'folder_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'created_by' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'parent_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'folder' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'location' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'password' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'name' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],

                'permission' =>[
                    'type' => 'INT',
                    'null'=>true,
                    'default'=>0
                ],

                'slug' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('folder_id', true);
        $this->forge->createTable('folder_models');
	}

	public function down()
	{
		//
	}
}
