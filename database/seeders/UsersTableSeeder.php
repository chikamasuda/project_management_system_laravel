<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'      => 'テストユーザー１',
                'email'     => 'testuser01@gmail.com',
                'password'  => Hash::make('password'),
            ],
            [
                'name'      => 'テストユーザー２',
                'email'     => 'testuser02@gmail.com',
                'password'  => Hash::make('password'),
            ],
            [
                'name'      => 'テストユーザー３',
                'email'     => 'testuser03@gmail.com',
                'password'  => Hash::make('password'),
            ],
        ]);
    }
}
