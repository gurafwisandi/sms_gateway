<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'ini akun Admin',
                'email' => 'admin@gmail.com',
                'roles' => 'Admin',
                'password' => bcrypt('12345'),
                'status' => 'Aktif',
            ],
            [
                'name' => 'ini akun User (non admin)',
                'email' => 'user@gmail.com',
                'roles' => 'Guru',
                'status' => 'Aktif',
                'password' => bcrypt('12345'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
