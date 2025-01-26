<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migrations extends Migration
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
            'version' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'class' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'namespace' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'time' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'batch' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('id', true);

        // Create table
        $this->forge->createTable('migrations');

        // Insert default data
        $db = \Config\Database::connect();
        $builder = $db->table('migrations');

        $builder->insertBatch([
            [
                'id'       => 1,
                'version'  => '2017-11-20-223112',
                'class'    => 'Myth\Auth\Database\Migrations\CreateAuthTables',
                'namespace' => 'Myth\Auth',
                'time'     => 1732429767,
                'batch'    => 1,
            ],
            [
                'id'       => 3,
                'version'  => '2023-08-18-000002',
                'class'    => 'App\Database\Migrations\CreateKelasTable',
                'namespace' => 'App',
                'time'     => 1732429767,
                'batch'    => 1,
            ],
            [
                'id'       => 4,
                'version'  => '2023-08-18-000003',
                'class'    => 'App\Database\Migrations\CreateDB',
                'namespace' => 'App',
                'time'     => 1732429768,
                'batch'    => 1,
            ],
            [
                'id'       => 5,
                'version'  => '2023-08-18-000004',
                'class'    => 'App\Database\Migrations\AddSuperadmin',
                'namespace' => 'App',
                'time'     => 1732429768,
                'batch'    => 1,
            ],
            [
                'id'       => 6,
                'version'  => '2024-07-24-083011',
                'class'    => 'App\Database\Migrations\GeneralSettings',
                'namespace' => 'App',
                'time'     => 1732429768,
                'batch'    => 1,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('migrations');
    }
}
