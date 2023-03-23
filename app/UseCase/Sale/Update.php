<?php

namespace App\UseCase\Sale;

use App\Models\Sale;
use App\Http\Requests\SaleRequest;

class Update
{
    /**
     * 売上情報更新
     *
     * @param SaleRequest $request
     * @param Sale $sale
     * @return integer
     */
    public function invoke(SaleRequest $request, Sale $sale): int
    {
        $update_data = [
            'project_id' => $request->project_id,
            'status'     => $request->status,
            'content'    => $request->content,
            'amount'     => $request->amount,
            'sales_date' => $request->sales_date,
            'planned_deposit_date' => $request->planned_deposit_date,
            'deposit_date' => $request->deposit_date
        ];

        $update_sale = Sale::where('id', $sale->id)->update($update_data);

        return $update_sale;
    }
}
