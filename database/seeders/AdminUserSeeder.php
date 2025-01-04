<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Mahdiyar1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('123123123'), // Use a secure password
            'role' => 'admin',
        ]);
    }
}
