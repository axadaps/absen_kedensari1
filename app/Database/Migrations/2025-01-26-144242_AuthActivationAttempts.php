<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthActivationAttempts extends Migration
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
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'user_agent' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'token' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('auth_activation_attempts');
    }

    public function down()
    {
        $this->forge->dropTable('auth_activation_attempts');
    }
}
