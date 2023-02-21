<?php

namespace App\UseCase\Client;

use App\Models\Client;

class Destroy
{
    /**
     * 顧客情報削除
     *
     * @param Client $client
     * @return Client
     */
    public function invoke(Client $client): int
    {
        $client = Client::where('id', $client->id)->delete();
        return $client;
    }
}
