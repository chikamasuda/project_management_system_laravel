<?php

namespace App\UseCase\Sale;

use App\Models\Sale;
use App\Http\Requests\SaleRequest;

class Store
{
    /**
     * 売上情報作成
     *
     * @param SaleRequest $request
     * @return object
     */
    public function invoke(SaleRequest $request): object
    {
        $sale = Sale::create([
            'project_id' => $request->project_id,
            'status'     => $request->status,
            'content'    => $request->content,
            'amount'     => $request->amount,
            'sales_date' => $request->sales_date,
            'planned_deposit_date' => $request->planned_deposit_date,
            'deposit_date' => $request->deposit_date
        ]);

        return $sale;
    }
}
