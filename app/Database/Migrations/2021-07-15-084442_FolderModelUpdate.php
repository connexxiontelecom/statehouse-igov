<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FolderModelUpdate extends Migration
{
	public function up()
	{
        $fields = [
            'visibility' => [
                'type' => 'INT',
                'null'=>true,
                'default'=>2,
                'comment'=>'1=private,2=public'
            ]
        ];
        $this->forge->addColumn('folder_models', $fields);
	}

	public function down()
	{
		//
	}
}
