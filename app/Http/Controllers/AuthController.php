<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\UseCase\Auth\Login as LoginUseCase;
use App\UseCase\Auth\Logout as LogoutUseCase;
use App\UseCase\Auth\GetUserInformation as GetUserInformationUseCase;
use App\UseCase\Auth\Register as RegisterUseCase;

class AuthController extends Controller
{
    /**
     * ログイン
     *
     * @param LoginRequest $request
     * @param LoginUseCase $useCase
     * @return JsonResponse
     */
    public function login(LoginRequest $request, LoginUseCase $useCase): JsonResponse
    {
        try {
            $token = $useCase->invoke($request);
            return response()->json(['token' => $token], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * ログアウト
     *
     * @param Request $request
     * @param LogoutUseCase $useCase
     * @return JsonResponse
     */
    public function logout(Request $request, LogoutUseCase $useCase): JsonResponse
    {
        try {
            $useCase->invoke($request);
            return response()->json(['message' => 'Logged out.'], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * ユーザー情報取得
     *
     * @param GetUserInformationUseCase $useCase
     * @return JsonResponse
     */
    public function me(GetUserInformationUseCase $useCase): JsonResponse
    {
        try {
            $user = $useCase->invoke();
            return response()->json(['user' => $user], 200);
        } catch (\Throwable $e) {
            // 失敗した原因をログに残しフロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * 新規登録処理
     *
     * @param RegisterRequest $request
     * @param RegisterUseCase $useCase
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, RegisterUseCase $useCase): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = $useCase->invoke($request);
            DB::commit();
            return response()->json(['user' => $user['user'], 'token' => $user['token']], 201);
        } catch (\Throwable $e) {
            // 失敗したらロールバックし、原因をログに残しフロントにエラーを通知
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }
}
