<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'client_id'  => '2',
                'status'     => '1',
                'name'       => 'プロジェクト１',
                'start_date' => null,
                'end_date'   => null,
                'image_url'  => 'https://picsum.photos/150/150?random',
                'content'    => 'クライアントのテストデータ１',
            ],
            [
                'client_id'  => '1',
                'status'     => '2',
                'name'       => 'プロジェクト２',
                'start_date' => '2020-03-01',
                'end_date'   => '2023-03-31',
                'image_url'  => 'https://picsum.photos/150/150?random',
                'content'    => 'クライアントのテストデータ２',
            ],
            [
                'client_id'  => '3',
                'status'     => '3',
                'name'       => 'プロジェクト３',
                'start_date' => '2020-10-01',
                'end_date'   => '2021-10-31',
                'image_url'  => 'https://picsum.photos/150/150?random',
                'content'    => 'クライアントのテストデータ３',
            ],
            [
                'client_id'  => '4',
                'status'     => '2',
                'name'       => 'プロジェクト４',
                'start_date' => '2022-04-01',
                'end_date'   => '2023-10-31',
                'image_url'  => 'https://picsum.photos/150/150?random',
                'content'    => 'クライアントのテストデータ４',
            ],
        ]);
    }
}
