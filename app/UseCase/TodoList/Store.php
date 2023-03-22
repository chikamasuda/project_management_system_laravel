<?php

namespace App\UseCase\TodoList;

use App\Models\TodoList;
use App\Http\Requests\TodoListRequest;

class Store
{
    /**
     * todoリスト作成
     *
     * @param TodoListRequest $request
     * @return object
     */
    public function invoke(TodoListRequest $request): object
    {
        $todo = TodoList::create([
            'user_id'       => auth()->user()->id,
            "title"         => $request->title,
            "deadline_date" => $request->deadline_date,
            "status"        => false,
        ]);

        return $todo;
    }
}
