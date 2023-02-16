<?php

namespace App\UseCase\Home;

use App\Models\Project;
use App\Models\TodoList;

class GetUserInformation
{
    /**
     * ユーザーの案件とTODOの情報取得
     *
     * @return array
     */
    public function invoke(): array
    {
        $projects = Project::query()
            ->join('clients', 'projects.client_id', '=', 'clients.id')
            ->select('projects.name as project_name', 'clients.name as client_name', 'projects.status as status', 'end_date')
            ->where('user_id', auth()->user()->id)
            ->where('projects.status', '!=', config('const.projects.end'))
            ->get();

        $todo_lists = TodoList::where('user_id', auth()->user()->id)
            ->where('status', false)
            ->get();

        return [
            'projects'   => $projects,
            'todo_lists' => $todo_lists
        ];
    }
}
