<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbKehadiran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kehadiran' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kehadiran' => [
                'type'       => 'ENUM',
                'constraint' => ['Hadir', 'Sakit', 'Izin', 'Tanpa keterangan'],
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_kehadiran');
        $this->forge->createTable('tb_kehadiran');

        $this->forge->getConnection()->query("INSERT INTO tb_kehadiran (id_kehadiran, kehadiran) VALUES
            (1, 'Hadir'),
            (2, 'Sakit'),
            (3, 'Izin'),
            (4, 'Tanpa keterangan');");
    }

    public function down()
    {
        $this->forge->dropTable('tb_kehadiran');
    }
}
