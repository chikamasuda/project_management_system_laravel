<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'テストユーザー',
            'email'     => 'testuser01@gmail.com',
            'password'  => Hash::make('password'),
        ]);
    }
}
