<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateWorkflowRequestTable extends Migration
{
	public function up()
	{
        $fields = [
            'request_status' => [
                'type' => 'INT',
                'null'=>true,
                'default'=>0,
                'comment'=>'0=pending,1=approved, 2=declined'
            ]
        ];
        $this->forge->addColumn('workflow_requests', $fields);
	}

	public function down()
	{
		//
	}
}
