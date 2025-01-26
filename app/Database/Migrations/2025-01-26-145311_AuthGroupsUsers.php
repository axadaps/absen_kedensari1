<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthGroupsUsers extends Migration
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
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 0,
            ],
        ]);

        $this->forge->addKey('group_id', false, true);
        $this->forge->addKey('user_id', false, true);

        $this->forge->createTable('auth_groups_users');
    }

    public function down()
    {
        $this->forge->dropTable('auth_groups_users');
    }
}
