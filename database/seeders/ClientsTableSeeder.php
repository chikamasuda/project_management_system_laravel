<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            [
                'user_id'   => '1',
                'status'    => '2',
                'name'      => 'クライアント１',
                'address'   => '東京都練馬区上石神井1-1-1',
                'email'     => 'client01@gmail.com',
                'image_url' => 'https://picsum.photos/150/150?random',
                'site_url'  => 'https://vuetifyjs.com/',
                'memo'      => 'クライアントのテストデータ１',
            ],
            [
                'user_id'   => '1',
                'status'    => '1',
                'name'      => 'クライアント２',
                'address'   => '東京都練馬区上石神井1-1-2',
                'email'     => 'client02@gmail.com',
                'image_url' => 'https://picsum.photos/150/150?random',
                'site_url'  => 'https://vuetifyjs.com/',
                'memo'      => 'クライアントのテストデータ２',
            ],
            [
                'user_id'   => '1',
                'status'    => '3',
                'name'      => 'クライアント３',
                'address'   => '東京都練馬区上石神井1-1-3',
                'email'     => 'client03@gmail.com',
                'image_url' => 'https://picsum.photos/150/150?random',
                'site_url'  => 'https://vuetifyjs.com/',
                'memo'      => 'クライアントのテストデータ３',
            ],
            [
                'user_id'   => '2',
                'status'    => '2',
                'name'      => 'クライアント４',
                'address'   => '東京都練馬区上石神井1-1-4',
                'email'     => 'client04@gmail.com',
                'image_url' => 'https://picsum.photos/150/150?random',
                'site_url'  => 'https://vuetifyjs.com/',
                'memo'      => 'クライアントのテストデータ４',
            ],
        ]);
    }
}
