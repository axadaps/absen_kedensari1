<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthLogins extends Migration
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
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'success' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
            ],
        ]);

        // Tambahkan primary key
        $this->forge->addKey('id', true);

        // Buat tabel
        $this->forge->createTable('auth_logins');
    }

    public function down()
    {
        // Hapus tabel jika rollback
        $this->forge->dropTable('auth_logins');
    }
}
