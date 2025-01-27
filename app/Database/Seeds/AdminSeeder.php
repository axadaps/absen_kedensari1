<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Password;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $email = 'adminsuper@gmail.com';
        $username = 'superadmin';
        $password = 'dibawahmeja';

        $encryptedPassword = Password::hash($password);

        $data = [
            'email'          => $email,
            'username'       => $username,
            'is_superadmin'  => 1,
            'password_hash'  => $encryptedPassword,
            'active'         => 1,
        ];

        $this->db->table('users')->insert($data);
    }
}
