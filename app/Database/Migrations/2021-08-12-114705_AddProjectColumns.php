<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProjectColumns extends Migration
{
	public function up()
	{
        $fields = [
            'project_start_date' => [
                'type' => 'DATE',
                'null'=>true,
            ],
            'project_end_date' => [
                'type' => 'DATE',
                'null'=>true,
            ],
            'project_budget' => [
                'type' => 'DOUBLE',
                'null'=>true,
                'default'=>0
            ],
            'project_privacy' => [
                'type' => 'INT',
                'null'=>true,
                'default'=>1,
                'comment'=>'1=private,2=public,3=team'
            ],
        ];
        $this->forge->addColumn('projects', $fields);
	}

	public function down()
	{
		//
	}
}
