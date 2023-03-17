<?php

namespace App\UseCase\Project;

use App\Models\Project;
use App\Models\Client;
use Illuminate\Http\Request;

class Search
{
    /**
     * ユーザーの案件情報検索
     *
     * @param Request $request
     * @return object
     */
    public function invoke(Request $request): object
    {
        $clients = Client::where('user_id', auth()->user()->id)
            ->pluck('id');

        $query = Project::with(['client','tags'])
            ->whereIn('client_id', $clients);

        $keyword = $request->keyword;

        if (!empty($keyword)) {
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($keyword, 's');
            //キーワードを半角スペースごとに区切る
            $array_keyword = explode(' ', $spaceConversion);
            //キーワード絞り込み
            $query->where(function ($query) use ($array_keyword) {
                foreach ($array_keyword as $keyword_item) {
                    $query->where('name', 'like', "%{$keyword_item}%")
                        ->orWhere('image_url', 'like', "%{$keyword_item}%")
                        ->orWhere('content', 'like', "%{$keyword_item}%")
                        ->orWhereHas('tags', function ($query) use ($keyword_item) {
                            $query->where('name', 'like', "%{$keyword_item}%");
                        })
                        ->orWhereHas('client', function ($query) use ($keyword_item) {
                            $query->where('name', 'like', "%{$keyword_item}%");
                        });
                }
            });
        }

        $projects = $query->get();

        return $projects;
    }
}
