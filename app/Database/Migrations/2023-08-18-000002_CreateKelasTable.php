<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKelasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelas' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kelas' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('id_kelas', true);

        // Create table
        $this->forge->createTable('kelas');

        // Insert default data
        $db = \Config\Database::connect();
        $builder = $db->table('kelas');

        $builder->insertBatch([
            [
                'id_kelas'   => 16,
                'kelas'      => 1,
                'created_at' => '2024-12-04 19:59:16',
                'updated_at' => '2024-12-04 19:59:16',
                'deleted_at' => null,
            ],
            [
                'id_kelas'   => 18,
                'kelas'      => 2,
                'created_at' => '2024-12-04 19:59:33',
                'updated_at' => '2024-12-04 19:59:33',
                'deleted_at' => null,
            ],
            [
                'id_kelas'   => 19,
                'kelas'      => 3,
                'created_at' => '2024-12-04 19:59:37',
                'updated_at' => '2024-12-04 19:59:37',
                'deleted_at' => null,
            ],
            [
                'id_kelas'   => 20,
                'kelas'      => 4,
                'created_at' => '2024-12-04 19:59:40',
                'updated_at' => '2024-12-04 19:59:40',
                'deleted_at' => null,
            ],
            [
                'id_kelas'   => 21,
                'kelas'      => 5,
                'created_at' => '2024-12-04 19:59:45',
                'updated_at' => '2024-12-04 19:59:45',
                'deleted_at' => null,
            ],
            [
                'id_kelas'   => 22,
                'kelas'      => 6,
                'created_at' => '2024-12-04 19:59:49',
                'updated_at' => '2024-12-04 19:59:49',
                'deleted_at' => null,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('kelas');
    }
}
