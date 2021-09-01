<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Vendors extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'vendor_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'vendor_name' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'vendor_address' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'vendor_email' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'about_vendor' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'vendor_mobile_no' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'vendor_website' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'vendor_added_by' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('vendor_id', true);
        $this->forge->createTable('vendors');
	}

	public function down()
	{
		//
	}
}
