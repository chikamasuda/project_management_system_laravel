<?php

namespace App\UseCase\Client;

use App\Models\Client;

class Index
{
    /**
     * ユーザーの顧客情報取得
     *
     * @return object
     */
    public function invoke(): object
    {
        $clients = Client::with('tags')
            ->where('user_id', auth()->user()->id)
            ->get();

        return $clients;
    }
}
