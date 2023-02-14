<?php

namespace App\UseCase\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class Logout
{
    /**
     * ログアウト
     *
     * @param Request $request
     * @return void
     */
    public function invoke(Request $request)
    {
        $access_token = auth()->user()->token();
        $token = $request->user()->tokens->find($access_token);
        //トークン無効化
        $token->revoke();
    }
}
