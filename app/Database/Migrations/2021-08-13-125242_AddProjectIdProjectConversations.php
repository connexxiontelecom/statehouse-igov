<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProjectIdProjectConversations extends Migration
{
	public function up()
	{
        $fields = [
            'project_convo_project_id' => [
                'type' => 'INT',
                'null'=>true,
            ],
        ];
        $this->forge->addColumn('project_conversations', $fields);
	}

	public function down()
	{
		//
	}
}
