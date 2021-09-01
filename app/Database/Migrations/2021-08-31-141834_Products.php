<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
	public function up()
	{
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'product_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'product_name' =>[
                    'type' => 'TEXT',
                    'null'=>true,
                ],
                'category_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'vendor_id' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'cost_price' =>[
                    'type' => 'DOUBLE',
                    'null'=>true,
                    'default'=>0
                ],
                'selling_price' =>[
                    'type' => 'DOUBLE',
                    'null'=>true,
                    'default'=>0
                ],
                'quantity' =>[
                    'type' => 'INT',
                    'null'=>true,
                    'default'=>0
                ],
                'in_stock' =>[
                    'type' => 'INT',
                    'null'=>true,
                    'default'=>0
                ],
                'added_by' =>[
                    'type' => 'INT',
                    'null'=>true,
                ],
                'created_at datetime default current_timestamp',

            ]
        );
        $this->forge->addKey('product_id', true);
        $this->forge->createTable('products');
	}

	public function down()
	{
		//
	}
}
