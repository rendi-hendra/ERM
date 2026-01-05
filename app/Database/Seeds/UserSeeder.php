<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insert([
            'id_employee' => 5,
            'username' => 'rendi',
            'password' => password_hash('rendi', PASSWORD_DEFAULT),
        ]);
    }
}
