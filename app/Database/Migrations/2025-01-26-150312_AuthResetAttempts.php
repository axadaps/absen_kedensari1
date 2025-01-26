<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthResetAttempts extends Migration
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
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'collation'  => 'utf8_general_ci',
                'null'       => false,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'collation'  => 'utf8_general_ci',
                'null'       => false,
            ],
            'user_agent' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'collation'  => 'utf8_general_ci',
                'null'       => false,
            ],
            'token' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'collation'  => 'utf8_general_ci',
                'null'       => true,
                'default'    => null,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => false,
            ],
        ]);

        $this->forge->addKey('id', true); 
        $this->forge->createTable('auth_reset_attempts'); 
    }

    public function down()
    {
        $this->forge->dropTable('auth_reset_attempts');
    }
}
