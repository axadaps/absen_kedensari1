<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthGroups extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('auth_groups');
    }

    public function down()
    {
        $this->forge->dropTable('auth_groups');
    }
}