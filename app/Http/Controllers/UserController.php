<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\UseCase\User\Update as UpdateUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    /**
     * ユーザー情報更新
     *
     * @param UpdateUseCase $useCase
     * @param UserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateUseCase $useCase, UserRequest $request, User $user): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = $useCase->invoke($request, $user);
            if (!$user) {
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
}
