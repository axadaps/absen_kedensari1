<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthGroupsPermissions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'group_id' => [
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

        $this->forge->addKey('group_id', false, true);
        $this->forge->addKey('permission_id', false, true);

        $this->forge->createTable('auth_groups_permissions');
    }

    public function down()
    {
        $this->forge->dropTable('auth_groups_permissions');
    }
}
