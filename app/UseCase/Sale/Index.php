<?php

namespace App\UseCase\Sale;

use App\Models\Sale;
use App\Models\Project;
use App\Models\Client;

class Index
{
    /**
     * 売上の情報取得
     *
     * @return object
     */
    public function invoke(): object
    {
        $clients = Client::where('user_id', auth()->user()->id)
            ->pluck('id');

        $project_id = Project::whereIn('client_id', $clients)
            ->pluck('id');

        $sales = Sale::with(['project'])->whereIn('project_id', $project_id)->get();

        return $sales;
    }
}
