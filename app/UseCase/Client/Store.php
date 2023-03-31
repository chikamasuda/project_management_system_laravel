<?php

namespace App\UseCase\Client;

use App\Models\Client;
use App\Models\Tag;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class Store
{
    /**
     * 顧客情報作成
     *
     * @param ClientRequest $request
     * @return array
     */
    public function invoke(ClientRequest $request): array
    {
        $client = Client::create([
            'name'      => $request->name,
            'user_id'   => auth()->user()->id,
            'email'     => $request->email,
            "address"   => $request->address,
            "status"    => $request->status,
            "site_url"  => $request->site_url,
            "memo"      => $request->memo,
        ]);

        //s3にアップして保存
        if ($request->file('image')) {
            $image_name = $request->file('image')->getClientOriginalName();
            $extension = pathinfo($image_name)['extension'];
            $path = $request->file('image')->storeAs('', 'client-' . $client->id . '.' . $extension, 's3');
            $client->update(['image_url' => Storage::disk('s3')->url($path)]);
        }

        $tag_array = [];
        $tag = [];

        foreach ($request->tags as $tag_name) {
            if ($tag_name) {
                $tag = Tag::firstOrCreate(['name' => $tag_name]);
                array_push($tag_array, $tag->id);
            }
        }

        if (!empty($tag_array)) {
            $client = Client::where('id', $client->id)->first();
            $client->tags()->attach($tag_array);
        }

        return [
            'client' => $client,
            'tag'    => $tag
        ];
    }
}
