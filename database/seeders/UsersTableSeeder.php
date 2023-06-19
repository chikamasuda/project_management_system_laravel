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
                'image_url' => 'https://masudabucket2.s3.ap-northeast-1.amazonaws.com/user-1.jpg',
            ],
            [
                'name'      => 'テストユーザー２',
                'email'     => 'testuser02@gmail.com',
                'password'  => Hash::make('password'),
                'image_url' => ''
            ],
            [
                'name'      => 'テストユーザー３',
                'email'     => 'testuser03@gmail.com',
                'password'  => Hash::make('password'),
                'image_url' => ''
            ],
        ]);
    }
}
