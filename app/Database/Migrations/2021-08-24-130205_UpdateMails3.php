<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateMails3 extends Migration
{
	public function up()
	{
    $this->db->disableForeignKeyChecks();
    $fields = [
      'm_source' => [
        'type' => 'INT',
      ],

      'm_post_id' => [
        'type' => 'INT'
      ],

      'm_acknowledgement' => [
        'type' => 'TEXT',
      ],
    ];
    $this->forge->addColumn('mails', $fields);
	}

	public function down()
	{
		//
	}
}
