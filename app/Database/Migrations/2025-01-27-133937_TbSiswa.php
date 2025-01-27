<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_siswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nis' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
            'nama_siswa' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'id_kelas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
                'null' => false,
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
            ],
            'unique_code' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
        ]);

        $this->forge->addKey('id_siswa', true); // Primary key
        $this->forge->addKey('id_kelas'); // Foreign key

        $this->forge->createTable('tb_siswa');
    }

    public function down()
    {
        $this->forge->dropTable('tb_siswa');
    }
}
