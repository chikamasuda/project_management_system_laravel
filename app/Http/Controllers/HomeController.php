<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\TodoList;
use App\UseCase\Home\GetUserInformation as GetUserInformationUseCase;

class HomeController extends Controller
{
    /**
     * ユーザーの案件とTODOの情報取得
     *
     * @return void
     */
    public function index(GetUserInformationUseCase $useCase)
    {
        try {
            $index = $useCase->invoke();
            return response()->json(['projects' => $index['projects'], 'todo_lists' => $index['todo_lists']], 200);
        } catch (\Throwable $e) {
            // 失敗した原因をログに残しフロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }
}
