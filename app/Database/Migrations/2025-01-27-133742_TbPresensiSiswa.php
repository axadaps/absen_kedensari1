<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPresensiSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_presensi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_siswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_kelas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'jam_masuk' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'jam_keluar' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'id_kehadiran' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id_presensi', true); // Primary key
        $this->forge->addKey('id_siswa'); // Foreign key
        $this->forge->addKey('id_kelas'); // Foreign key
        $this->forge->addKey('id_kehadiran'); // Foreign key

        $this->forge->createTable('tb_presensi_siswa');
    }

    public function down()
    {
        $this->forge->dropTable('tb_presensi_siswa');
    }
}
