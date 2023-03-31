<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\UseCase\Project\Index as IndexUseCase;
use App\UseCase\Project\Store as StoreUseCase;
use App\UseCase\Project\Show as ShowUseCase;
use App\UseCase\Project\Update as UpdateUseCase;
use App\UseCase\Project\Destroy as DestroyUseCase;
use App\UseCase\Project\Search as SearchUseCase;
use App\UseCase\Project\Download as DownloadUseCase;

class ProjectController extends Controller
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
            $projects = $useCase->invoke();
            return response()->json(['projects' => $projects], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 案件情報作成
     *
     * @param StoreUseCase $useCase
     * @param ProjectRequest $request
     * @return JsonResponse
     */
    public function store(StoreUseCase $useCase, ProjectRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $project = $useCase->invoke($request);
            DB::commit();
            return response()->json(['project' => $project['project'], 'tag' => $project['tag']], 201);
        } catch (\Throwable $e) {
            // 失敗したらロールバックし、原因をログに残しフロントにエラーを通知
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * ユーザーの案件詳細情報取得
     *
     * @param ShowUseCase $useCase
     * @param Project $project
     * @return JsonResponse
     */
    public function show(ShowUseCase $useCase, Project $project): JsonResponse
    {
        try {
            $project = $useCase->invoke($project);
            return response()->json(['project' => $project], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 案件情報更新
     *
     * @param UpdateUseCase $useCase
     * @param projectRequest $request
     * @param Project $project
     * @return JsonResponse
     */
    public function update(UpdateUseCase $useCase, ProjectRequest $request, Project $project): JsonResponse
    {
        try {
            DB::beginTransaction();
            $update_project = $useCase->invoke($request, $project);
            if (!$update_project) {
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
     * 案件情報削除
     *
     * @param DestroyUseCase $useCase
     * @param Project $project
     * @return JsonResponse
     */
    public function destroy(DestroyUseCase $useCase, Project $project): JsonResponse
    {
        try {
            DB::beginTransaction();
            $project = $useCase->invoke($project);
            if (!$project) {
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
     * ユーザーの案件情報検索
     *
     * @param SearchUseCase $useCase
     * @return JsonResponse
     */
    public function search(SearchUseCase $useCase, Request $request): JsonResponse
    {
        try {
            $projects = $useCase->invoke($request);
            return response()->json(['projects' => $projects], 200);
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
