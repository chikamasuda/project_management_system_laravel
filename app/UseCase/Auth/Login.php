<?php

namespace App\UseCase\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;


class Login
{
    /**
     * ログイン処理
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function invoke(LoginRequest $request): JsonResponse
    {
        //ユーザー情報取得
        $user = User::where('email', $request->email)->first();

        //ログインチェック
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        //トークン発行
        $client = DB::table('oauth_clients')->where('password_client', true)->first();
        $data = [
            'username' => $request->email,
            'password' => $request->password,
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'grant_type' => 'password',
        ];
        $token_request = Request::create('/oauth/token', 'POST', $data);
        $token_response = Route::prepareResponse($token_request, app()->handle($token_request));
        $token = json_decode($token_response->content(), true);
        $token = $token['access_token'];

        return response()->json(['token' => $token], 200);
    }
}
