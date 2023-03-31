<?php

namespace App\UseCase\Project;

use App\Models\Project;
use App\Models\Tag;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class Store
{
    /**
     * 案件情報作成
     *
     * @param ProjectRequest $request
     * @return array
     */
    public function invoke(ProjectRequest $request): array
    {
        $project = Project::create([
            'name'        => $request->name,
            'client_id'   => $request->client_id,
            "status"      => $request->status,
            "start_date"  => $request->start_date,
            "end_date"    => $request->end_date,
            "content"     => $request->content,
        ]);

        //s3にアップして保存
        if ($request->file('image')) {
            $image_name = $request->file('image')->getClientOriginalName();
            $extension = pathinfo($image_name)['extension'];
            $path = $request->file('image')->storeAs('', 'project-' . $project->id . '.' . $extension, 's3');
            $project->update(['image_url' => Storage::disk('s3')->url($path)]);
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
            $project = Project::where('id', $project->id)->first();
            $project->tags()->attach($tag_array);
        }

        return [
            'project' => $project,
            'tag'     => $tag
        ];
    }
}
