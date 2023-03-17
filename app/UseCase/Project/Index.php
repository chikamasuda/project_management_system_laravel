<?php

namespace App\UseCase\Project;

use App\Models\Client;
use App\Models\Project;

class Index
{
    /**
     * ユーザーの案件情報取得
     *
     * @return object
     */
    public function invoke(): object
    {
        $clients = Client::where('user_id', auth()->user()->id)
            ->pluck('id');

        $projects = Project::with(['client','tags'])
            ->whereIn('client_id', $clients)
            ->get();

        return $projects;
    }
}
