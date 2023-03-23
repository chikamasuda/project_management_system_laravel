<?php

namespace App\UseCase\TodoList;

use App\Models\TodoList;

class Destroy
{
    /**
     * Todoリスト削除
     *
     * @param TodoList $todo_list
     * @return integer
     */
    public function invoke(TodoList $todo_list): int
    {
        $todo = TodoList::where('id', $todo_list->id)->delete();
        return $todo;
    }
}
