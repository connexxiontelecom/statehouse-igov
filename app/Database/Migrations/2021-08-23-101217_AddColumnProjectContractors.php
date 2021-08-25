<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnProjectContractors extends Migration
{
	public function up()
	{
        $fields = [
            'project_con_amount' => [
                'type' => 'DOUBLE',
                'null'=>true,
                'default'=>0
            ],
            'project_con_scope' => [
                'type' => 'TEXT',
                'null'=>true,
            ],
        ];
        $this->forge->addColumn('project_contractors', $fields);
	}

	public function down()
	{
		//
	}
}
