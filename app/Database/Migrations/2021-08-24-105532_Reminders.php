<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reminders extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'reminder_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'reminder_employee_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'title' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'reminder_start_date' =>[
                    'type' => 'DATETIME',
                    'null'=>true,
                ],
                'reminder_end_date' =>[
                    'type' => 'DATETIME',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('reminder_id', true);
        $this->forge->createTable('reminders');
	}

	public function down()
	{
		//
	}
}
