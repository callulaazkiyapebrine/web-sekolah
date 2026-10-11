<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sekolah.sch.id'],
            [
                'username' => 'Admin',
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'Admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'operator@sekolah.sch.id'],
            [
                'username' => 'operator',
                'name' => 'Operator Sekolah',
                'password' => Hash::make('password'),
                'role' => 'Operator',
            ]
        );
    }
}
