<?php

namespace App\UseCase\Client;

use App\Models\Client;
use App\Models\Tag;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Storage;

class Update
{
    /**
     * 顧客情報更新
     *
     * @param ClientRequest $request
     * @param Client $client
     * @return Client
     */
    public function invoke(ClientRequest $request, Client $client): int
    {
        //s3にアップして保存
        if ($request->file('image')) {
            $image_name = $request->file('image')->getClientOriginalName();
            $path = Storage::disk('s3')->putFile('', $request->file('image'), 'public');
            $request->file('image')->storeAs('/', $image_name, 's3');
        }

        $update = [
            "name"      => $request->name,
            'user_id'   => auth()->user()->id,
            'email'     => $request->email,
            "image_url" => $request->file('image') ? Storage::disk('s3')->url($path) . $image_name : null,
            "address"   => $request->address,
            "status"    => $request->status,
            "site_url"  => $request->site_url,
            "memo"      => $request->memo,
        ];

        $update_client = Client::where('id', $client->id)->update($update);

        if (isset($request->tags)) {
            foreach ($request->tags as $tag_name) {
                $tag = Tag::firstOrCreate(['name' => $tag_name]);
                $client = Client::where('id', $client->id)->first();
                $client->tags()->sync($tag, false);
            }
        }

        return $update_client;
    }
}
