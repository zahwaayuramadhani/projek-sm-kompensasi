<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $users = [
        [
            'username' => 'admin',
            'password' => bcrypt('123'),
            'level' => 1, // 1=admin
        ],
        [
            'username' => '240202064',
            'password' => bcrypt('123'),
            'level' => 2, // 2=mahasiswa
        ],
    ];

        array_map(function (array $user) {
            User::query()->updateOrCreate(
                ['username' => $user['username']],
                $user
            );
        }, $users);
    }
}
