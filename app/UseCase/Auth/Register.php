<?php

namespace App\UseCase\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class Register
{
    /**
     * 新規登録処理
     *
     * @param RegisterRequest $request
     * @return array
     */
    public function invoke(RegisterRequest $request): array
    {
        //ユーザー登録
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

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
        $token = $token_response->content();

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
