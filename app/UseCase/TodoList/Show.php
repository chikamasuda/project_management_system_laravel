<?php

namespace App\UseCase\TodoList;

use App\Models\TodoList;

class Show
{
    /**
     * todoリストの詳細情報取得
     *
     * @return TodoList
     */
    public function invoke(TodoList $todo_list): TodoList
    {
        $todo = TodoList::where('id', $todo_list->id)
            ->first();

        return $todo;
    }
}
