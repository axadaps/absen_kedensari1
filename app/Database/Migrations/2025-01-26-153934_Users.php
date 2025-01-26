<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => [
                'type'           => 'INT',
                'unsigned'      => true,
                'auto_increment' => true,
            ],
            'email'             => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'unique'         => true,
            ],
            'username'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'unique'         => true,
            ],
            'is_superadmin'     => [
                'type'           => 'BOOLEAN',
                'default'        => false,
            ],
            'password_hash'     => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'reset_hash'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'reset_at'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'reset_expires'     => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'activate_hash'     => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'status'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'status_message'    => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'active'            => [
                'type'           => 'BOOLEAN',
                'default'        => true,
            ],
            'force_pass_reset'  => [
                'type'           => 'BOOLEAN',
                'default'        => false,
            ],
            'created_at'        => [
                'type'           => 'DATETIME',
                'default'        => 'CURRENT_TIMESTAMP',
            ],
            'updated_at'        => [
                'type'           => 'DATETIME',
                'null'           => true,
                'on_update'      => 'CURRENT_TIMESTAMP',
            ],
            'deleted_at'        => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
