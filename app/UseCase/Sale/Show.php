<?php

namespace App\UseCase\Sale;

use App\Models\Sale;

class Show
{
    /**
     * 売上の詳細情報取得
     *
     * @return Sale
     */
    public function invoke(Sale $sale): Sale
    {
        $detail_sale = Sale::where('id', $sale->id)
            ->first();

        return $detail_sale;
    }
}
