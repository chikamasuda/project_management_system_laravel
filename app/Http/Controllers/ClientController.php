<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\UseCase\Client\Index as IndexUseCase;
use App\UseCase\Client\Store as StoreUseCase;
use App\UseCase\Client\Show as ShowUseCase;
use App\UseCase\Client\Update as UpdateuseCase;
use App\UseCase\Client\Destroy as DestroyuseCase;
use App\UseCase\Client\Search as SearchuseCase;
use App\UseCase\Client\Download as DownloaduseCase;

class ClientController extends Controller
{
    /**
     * ユーザーの顧客情報取得
     *
     * @param IndexUseCase $useCase
     * @return JsonResponse
     */
    public function index(IndexUseCase $useCase): JsonResponse
    {
        try {
            $clients = $useCase->invoke();
            return response()->json(['clients' => $clients], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 顧客情報作成
     *
     * @param StoreUseCase $useCase
     * @param ClientRequest $request
     * @return JsonResponse
     */
    public function store(StoreUseCase $useCase, ClientRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $client = $useCase->invoke($request);
            DB::commit();
            return response()->json(['client' => $client['client'], 'tag' => $client['tag']], 201);
        } catch (\Throwable $e) {
            // 失敗したらロールバックし、原因をログに残しフロントにエラーを通知
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * ユーザーの顧客詳細情報取得
     *
     * @param ShowUseCase $useCase
     * @param Client $client
     * @return JsonResponse
     */
    public function show(ShowUseCase $useCase, Client $client): JsonResponse
    {
        try {
            $client = $useCase->invoke($client);
            return response()->json(['client' => $client], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 顧客情報更新
     *
     * @param UpdateUseCase $useCase
     * @param ClientRequest $request
     * @param Client $client
     * @return JsonResponse
     */
    public function update(UpdateUseCase $useCase, ClientRequest $request, Client $client): JsonResponse
    {
        try {
            DB::beginTransaction();
            $update_client = $useCase->invoke($request, $client);
            if (!$update_client) {
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
     * 顧客情報削除
     *
     * @param DestroyuseCase $useCase
     * @param Client $client
     * @return JsonResponse
     */
    public function destroy(DestroyuseCase $useCase, Client $client): JsonResponse
    {
        try {
            DB::beginTransaction();
            $client = $useCase->invoke($client);
            if (!$client) {
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
     * ユーザーの顧客情報検索
     *
     * @param SearchUseCase $useCase
     * @return JsonResponse
     */
    public function search(SearchUseCase $useCase, Request $request): JsonResponse
    {
        try {
            $clients = $useCase->invoke($request);
            return response()->json(['clients' => $clients], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * CSVダウンロード
     *
     * @param DownloadUseCase $useCase
     * @param Request $request
     * @return void
     */
    public function download(DownloadUseCase $useCase, Request $request)
    {
        try {
            $csv_data = $useCase->invoke($request);
            return response()->make($csv_data['csv'], 200, $csv_data['headers']);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }
}
