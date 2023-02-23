<?php

namespace App\UseCase\Client;

use App\Models\Client;
use App\Models\Tag;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class Store
{
    public function invoke(ClientRequest $request): array
    {
        //s3にアップして保存
        if ($request->file('image')) {
            $image_name = $request->file('image')->getClientOriginalName();
            $path = Storage::disk('s3')->putFile('', $request->file('image'), 'public');
            $request->file('image')->storeAs('/', $image_name, 's3');
        }

        $client = Client::create([
            'name'      => $request->name,
            'user_id'   => auth()->user()->id,
            'email'     => $request->email,
            "image_url" => $request->file('image') ? Storage::disk('s3')->url($path) . $image_name : null,
            "address"   => $request->address,
            "status"    => $request->status,
            "site_url"  => $request->site_url,
            "memo"      => $request->memo,
        ]);

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
