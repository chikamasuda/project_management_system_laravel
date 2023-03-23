<?php

namespace App\UseCase\Sale;

use App\Models\Sale;

class Destroy
{
    /**
     * 売上情報削除
     *
     * @param Sale $sale
     * @return integer
     */
    public function invoke(Sale $sale): int
    {
        $sale = Sale::where('id', $sale->id)->delete();
        return $sale;
    }
}
