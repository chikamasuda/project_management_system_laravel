<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('todo_lists')->insert([
            [
                'user_id'       => '1',
                'title'         => 'タスク１',
                'status'        =>  false,
                'deadline_date' => '2023-08-20'
            ],
            [
                'user_id'       => '1',
                'title'         => 'タスク２',
                'status'        =>  false,
                'deadline_date' => '2023-08-31'
            ],
            [
                'user_id'       => '1',
                'title'         => 'タスク３',
                'status'        =>  false,
                'deadline_date' => '2023-08-15'
            ],
            [
                'user_id'       => '1',
                'title'         => 'タスク４',
                'status'        =>  true,
                'deadline_date' => '2023-08-03'
            ],
            [
                'user_id'       => '2',
                'title'         => 'タスク５',
                'status'        =>  false,
                'deadline_date' => '2023-08-20'
            ],
            [
                'user_id'       => '2',
                'title'         => 'タスク６',
                'status'        =>  false,
                'deadline_date' => '2023-08-31'
            ],
            [
                'user_id'       => '2',
                'title'         => 'タスク７',
                'status'        =>  false,
                'deadline_date' => '2023-03-15'
            ],
            [
                'user_id'       => '2',
                'title'         => 'タスク８',
                'status'        =>  true,
                'deadline_date' => '2023-03-03'
            ],
        ]);
    }
}
