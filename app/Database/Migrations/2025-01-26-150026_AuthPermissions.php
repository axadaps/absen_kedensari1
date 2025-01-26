<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthPermissions extends Migration
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
                'collation'  => 'utf8_general_ci',
                'null'       => false,
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'collation'  => 'utf8_general_ci',
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true); 
        $this->forge->createTable('auth_permissions'); 
    }

    public function down()
    {
        $this->forge->dropTable('auth_permissions'); 
    }
}
