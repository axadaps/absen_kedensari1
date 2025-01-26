<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthUsersPermissions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 0,
            ],
            'permission_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 0,
            ],
        ]);

        $this->forge->addKey('user_id');
        $this->forge->addKey('permission_id');

        $this->forge->createTable('auth_users_permissions');
    }

    public function down()
    {
        $this->forge->dropTable('auth_users_permissions');
    }
}
