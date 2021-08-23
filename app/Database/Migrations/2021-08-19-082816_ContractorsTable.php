<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContractorsTable extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'contractor_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'contractor_name' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'contractor_address' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'contractor_email' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'about_contractor' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'contractor_mobile_no' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'contractor_website' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'contractor_added_by' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('contractor_id', true);
        $this->forge->createTable('contractors');
	}

	public function down()
	{
		//
	}
}
