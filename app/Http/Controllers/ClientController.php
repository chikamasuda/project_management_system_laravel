<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Tag;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $clients = Client::with('tags')
                ->where('user_id', auth()->user()->id)
                ->get();

            return response()->json(['clients' => $clients], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

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

            DB::commit();
            return response()->json(['client' => $client, 'tag' => $tag], 201);
        } catch (\Throwable $e) {
            // 失敗したらロールバックし、原因をログに残しフロントにエラーを通知
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client): JsonResponse
    {
        try {
            $client = Client::with('tags')
                ->where('id', $client->id)
                ->first();
            return response()->json(['client' => $client], 200);
        } catch (\Throwable $e) {
            //失敗した原因をログに残し、フロントにエラーを通知
            Log::error($e);
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client): JsonResponse
    {
        try {
            DB::beginTransaction();

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

            if (!$update_client) {
                return response()->json(['message' => 'Not Found'], 404);
            }

            if (isset($request->tags)) {
                foreach ($request->tags as $tag_name) {
                    $tag = Tag::firstOrCreate(['name' => $tag_name]);
                    $client = Client::where('id', $client->id)->first();
                    $client->tags()->sync($tag, false);
                }
            }
            DB::commit();
            return response()->json(['message' => 'Updated successfully'], 200);
        } catch (\Throwable $e) {
            // 失敗したらロールバックし、原因をログに残しフロントにエラーを通知
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        try {
            DB::beginTransaction();
            $client = Client::where('id', $client->id)->delete();

            if (!$client) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            return response()->json(['message' => 'Deleted successfully'], 200);
        } catch (\Throwable $e) {
            // 失敗したらロールバックし、原因をログに残しフロントにエラーを通知
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }
}
