<?php

namespace App\UseCase\TodoList;

use App\Models\TodoList;
use App\Http\Requests\TodoListRequest;

class Update
{
    /**
     * todoリスト更新
     *
     * @param TodoListRequest $request
     * @param TodoList $todo_list
     * @return int
     */
    public function invoke(TodoListRequest $request, TodoList $todo_list): int
    {
        $update = [
            "title"         => $request->title,
            "deadline_date" => $request->deadline_date,
            "status"        => $request->status,
        ];

        $todo = TodoList::where('id', $todo_list->id)->update($update);

        return $todo;
    }
}
