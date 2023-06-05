<?php

namespace App\UseCase\Client;

use App\Models\Client;
use App\Models\Tag;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
            $extension = pathinfo($image_name)['extension'];
            $path = $request->file('image')->storeAs('', 'client-' . $client->id . '.' . $extension, 's3');
        }

        $update = [
            "name"      => $request->name,
            'user_id'   => auth()->user()->id,
            'email'     => $request->email,
            "image_url" => $request->file('image') ? Storage::disk('s3')->url($path) : $request->image_url,
            "address"   => $request->address,
            "status"    => $request->status,
            "site_url"  => $request->site_url,
            "memo"      => $request->memo,
        ];

        $update_client = Client::where('id', $client->id)->update($update);

        $tag_array = [];
        $tag = [];

        if($request->tags) {
            foreach ($request->tags as $tag_name) {
                if ($tag_name) {
                    $tag = Tag::firstOrCreate(['name' => $tag_name]);
                    array_push($tag_array, $tag->id);
                }
        }

        $client = Client::where('id', $client->id)->first();
        $client->tags()->sync($tag_array);

        }

        return $update_client;
    }
}
