<?php

namespace App\UseCase\Sale;

use App\Models\Sale;
use Illuminate\Http\Request;


class Analysis
{
    /**
     * 売上集計・分析
     *
     * @param Request $request
     * @return object
     */
    public function invoke(Request $request): object
    {
        $query = Sale::query();

        //抽出条件が入金＆年別
        if ($request->type === 'deposit' && $request->method === 'year') {
            $query->whereBetween('deposit_date', [$request->start_date, $request->end_date])
                ->selectRaw('SUM(amount) AS total_amount, DATE_FORMAT(deposit_date, "%Y") as year')
                ->groupBy('year');
        }

        //抽出条件が入金＆月別
        if ($request->type === 'deposit' && $request->method === 'month') {
            $query->whereBetween('deposit_date', [$request->start_date, $request->end_date])
                ->selectRaw('SUM(amount) AS total_amount, DATE_FORMAT(deposit_date, "%Y%m") as month')
                ->groupBy('month');
        }

        //抽出条件が売上＆年別
        if ($request->type  === 'sales' && $request->method === 'year') {
            $query->whereBetween('sales_date', [$request->start_date, $request->end_date])
                ->selectRaw('SUM(amount) AS total_amount, DATE_FORMAT(sales_date, "%Y") as year')
                ->groupBy('year');
        }

        //抽出条件が売上＆月別
        if ($request->type  === 'sales' && $request->method === 'month') {
            $query->whereBetween('sales_date', [$request->start_date, $request->end_date])
                ->selectRaw('SUM(amount) AS total_amount, DATE_FORMAT(sales_date, "%Y%m") as month')
                ->groupBy('month');
        }

        $analysis = $query->get();

        return $analysis;
    }
}
