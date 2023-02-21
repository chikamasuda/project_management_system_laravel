<?php

namespace App\UseCase\Client;

use App\Models\Client;
use App\Models\Tag;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Storage;

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

        if (isset($request->tags)) {
            foreach ($request->tags as $tag_name) {
                $tag = Tag::firstOrCreate(['name' => $tag_name]);
                $client->tags()->attach($tag);
            }
        }

        return [
            'client' => $client,
            'tag'    => $tag
        ];
    }
}
