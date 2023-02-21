<?php

namespace App\UseCase\Client;

use App\Models\Client;

class Show
{
    /**
     * ユーザーの顧客詳細情報取得
     *
     * @return Client
     */
    public function invoke(Client $client): Client
    {
        $client = Client::with('tags')
            ->where('id', $client->id)
            ->first();

        return $client;
    }
}
