<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\Log;
use App\UseCase\Sale\Analysis as AnalysisUseCase;
use App\UseCase\Sale\Index as IndexUseCase;
use App\UseCase\Sale\Store as StoreUseCase;
use App\UseCase\Sale\Show as ShowUseCase;
use App\UseCase\Sale\Update as UpdateUseCase;
use App\UseCase\Sale\Destroy as DestroyUseCase;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * 売上情報取得
     *
     * @param IndexUseCase $useCase
     * @return JsonResponse
     */
    public function index(IndexUseCase $useCase): JsonResponse
    {
        try {
            $sales = $useCase->invoke();
            return response()->json(['sales' => $sales], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 売上情報作成
     *
     * @param CreateUseCase $useCase
     * @param SaleRequest $request
     * @return JsonResponse
     */
    public function store(StoreUseCase $useCase, SaleRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $sale = $useCase->invoke($request);
            DB::commit();
            return response()->json(['sale' => $sale], 201);
        } catch (\Throwable $e) {
            // 失敗したらロールバックし、原因をログに残しフロントにエラーを通知
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 売上の詳細情報取得
     *
     * @param ShowUseCase $useCase
     * @param TodoList $todo_list
     * @return JsonResponse
     */
    public function show(ShowUseCase $useCase, Sale $sale): JsonResponse
    {
        try {
            $detail_sale = $useCase->invoke($sale);
            if (!$detail_sale) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            return response()->json(['detail_sale' => $detail_sale], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 売上情報更新
     *
     * @param UpdateUseCase $useCase
     * @param SaleRequest $request
     * @param Sale $sale
     * @return JsonResponse
     */
    public function update(UpdateUseCase $useCase, SaleRequest $request, Sale $sale): JsonResponse
    {
        try {
            DB::beginTransaction();
            $update_sale = $useCase->invoke($request, $sale);
            if (!$update_sale) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            DB::commit();
            return response()->json(['message' => 'Updated successfully'], 200);
        } catch (\Throwable $e) {
            // 失敗したらロールバックし、原因をログに残しフロントにエラーを通知
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 売上情報削除
     *
     * @param DestroyUseCase $useCase
     * @param TodoList $todo_list
     * @return JsonResponse
     */
    public function destroy(DestroyUseCase $useCase, Sale $sale): JsonResponse
    {
        try {
            DB::beginTransaction();
            $sale = $useCase->invoke($sale);
            if (!$sale) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            DB::commit();
            return response()->json(['message' => 'Deleted successfully'], 200);
        } catch (\Throwable $e) {
            // 失敗したらロールバックし、原因をログに残しフロントにエラーを通知
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

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
