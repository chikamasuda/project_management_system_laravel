<?php

namespace App\UseCase\TodoList;

use App\Models\TodoList;

class Index
{
    /**
     * todoリストの情報取得
     *
     * @return object
     */
    public function invoke(): object
    {
        $todo_lists = TodoList::where('user_id', auth()->user()->id)->get();

        return $todo_lists;
    }
}
