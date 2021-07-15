<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ShareFiles extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'share_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'file_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'shared_by' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'shared_with' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('share_id', true);
        $this->forge->createTable('shared_files');
	}

	public function down()
	{
		//
	}
}
