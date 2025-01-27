<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbKelas extends Migration
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
                'type'       => 'VARCHAR',
                'constraint' => '32',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'on update' => 'CURRENT_TIMESTAMP', // Automatically update on record change
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id_kelas', true);
        $this->forge->createTable('tb_kelas');             

        // Insert initial data
        $data = [
            ['id_kelas' => 1, 'kelas' => 'I',   'created_at' => '2025-01-27 19:54:50', 'updated_at' => '2025-01-27 19:54:50'],
            ['id_kelas' => 2, 'kelas' => 'II',  'created_at' => '2025-01-27 19:54:50', 'updated_at' => '2025-01-27 19:54:50'],
            ['id_kelas' => 3, 'kelas' => 'III', 'created_at' => '2025-01-27 19:54:50', 'updated_at' => '2025-01-27 19:54:50'],
            ['id_kelas' => 4, 'kelas' => 'IV',  'created_at' => '2025-01-27 19:54:50', 'updated_at' => '2025-01-27 19:54:50'],
            ['id_kelas' => 5, 'kelas' => 'V',   'created_at' => '2025-01-27 19:54:50', 'updated_at' => '2025-01-27 19:54:50'],
            ['id_kelas' => 6, 'kelas' => 'VI',  'created_at' => '2025-01-27 19:54:50', 'updated_at' => '2025-01-27 19:54:50'],
        ];

        $this->db->table('tb_kelas')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('tb_kelas');
    }
}
