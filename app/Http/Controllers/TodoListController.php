<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;
use App\UseCase\TodoList\Index as IndexUseCase;
use App\UseCase\TodoList\Store as StoreUseCase;
use App\UseCase\TodoList\Show as ShowUseCase;
use App\UseCase\TodoList\Update as UpdateUseCase;
use App\UseCase\TodoList\Destroy as DestroyUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\TodoListRequest;
use Illuminate\Support\Facades\DB;

class TodoListController extends Controller
{
    /**
     * todoリスト情報取得
     *
     * @param IndexUseCase $useCase
     * @return JsonResponse
     */
    public function index(IndexUseCase $useCase): JsonResponse
    {
        try {
            $todo_lists = $useCase->invoke();
            return response()->json(['todo_lists' => $todo_lists], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * todoリスト作成
     *
     * @param CreateUseCase $useCase
     * @param TodoListRequest $request
     * @return JsonResponse
     */
    public function store(StoreUseCase $useCase, TodoListRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $todo = $useCase->invoke($request);
            DB::commit();
            return response()->json(['todo' => $todo], 201);
        } catch (\Throwable $e) {
            // 失敗したらロールバックし、原因をログに残しフロントにエラーを通知
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * todoリストの詳細情報取得
     *
     * @param ShowUseCase $useCase
     * @param TodoList $todo_list
     * @return JsonResponse
     */
    public function show(ShowUseCase $useCase, TodoList $todo_list): JsonResponse
    {
        try {
            $todo = $useCase->invoke($todo_list);
            if (!$todo) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            return response()->json(['todo' => $todo], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * todoリスト更新
     *
     * @param UpdateUseCase $useCase
     * @param TodoListRequest $request
     * @param TodoList $todo_list
     * @return JsonResponse
     */
    public function update(UpdateUseCase $useCase, TodoListRequest $request, TodoList $todo_list): JsonResponse
    {
        try {
            DB::beginTransaction();
            $todo = $useCase->invoke($request, $todo_list);
            if (!$todo) {
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
     * todoリスト削除
     *
     * @param DestroyUseCase $useCase
     * @param TodoList $todo_list
     * @return JsonResponse
     */
    public function destroy(DestroyUseCase $useCase, TodoList $todo_list): JsonResponse
    {
        try {
            DB::beginTransaction();
            $todo = $useCase->invoke($todo_list);
            if (!$todo) {
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
}
