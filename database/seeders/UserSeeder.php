<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama_depan' => 'Admin',
                'nama_belakang' => 'Admin',
                'email' => 'admin@gmail.com',
                'tanggal_lahir' => '2004-04-05',
                'jenis_kelamin' => 'Perempuan',
                'password' => Hash::make('Admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
