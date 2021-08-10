<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmailSettings extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'email_settings_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'port_no' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'username' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'hostname' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'password' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'employee_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('email_settings_id', true);
        $this->forge->createTable('email_settings');
	}

	public function down()
	{
		//
	}
}
