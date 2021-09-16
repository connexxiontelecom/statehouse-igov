<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateMigration extends Migration
{
    public function up()
    {
      $this->db->disableForeignKeyChecks();
      $fields = [
        'target_id' => [
          'name' => 'target_ids',
          'type' => 'TEXT',
        ],
      ];
      $this->forge->modifyColumn('notifications', $fields);
    }

    public function down()
    {
        //
    }
}
