<?php

namespace App\UseCase\User;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class Update
{
    /**
     * ユーザー情報更新
     *
     * @param UserRequest $request
     * @param User $user
     * @return int
     */
    public function invoke(UserRequest $request, User $user): int
    {
        //s3にアップして保存
        if ($request->file('image')) {
            $image_name = $request->file('image')->getClientOriginalName();
            $extension = pathinfo($image_name)['extension'];
            $path = $request->file('image')->storeAs('', 'user-' . $user->id . '.' . $extension, 's3');
        }

        $update_data = [
            "name"      => $request->name,
            'email'     => $request->email,
            "image_url" => $request->file('image') ? Storage::disk('s3')->url($path) : null,
            "password"  => Hash::make($request->password)
        ];

        $user = User::where('id', $user->id)->update($update_data);

        return $user;
    }
}
