<?php

namespace App\UseCase\Auth;

use App\Models\User;

class GetUserInformation
{
    /**
     * ユーザー情報取得
     *
     * @return User
     */
    public function invoke(): User
    {
        $user = User::where('id', auth()->user()->id)
            ->first();

        return $user;
    }
}
