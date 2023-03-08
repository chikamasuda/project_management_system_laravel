<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\UseCase\Sale\Analysis as AnalysisUseCase;

class SaleController extends Controller
{
    /**
     * 売上分析・集計
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function analysis(Request $request, AnalysisUseCase $useCase): JsonResponse
    {
        try {
            $analysis = $useCase->invoke($request);
            return response()->json(['analysis' => $analysis], 200);
        } catch (\Throwable $e) {
            // 失敗した原因をログに残しフロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }
}
