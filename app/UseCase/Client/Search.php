<?php

namespace App\UseCase\Client;

use App\Models\Client;
use Illuminate\Http\Request;

class Search
{
    /**
     * ユーザーの顧客情報検索
     *
     * @param Request $request
     * @return object
     */
    public function invoke(Request $request): object
    {
        $query = Client::with('tags')
            ->where('user_id', auth()->user()->id);

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
                        ->orWhere('address', 'like', "%{$keyword_item}%")
                        ->orWhere('image_url', 'like', "%{$keyword_item}%")
                        ->orWhere('email', 'like', "%{$keyword_item}%")
                        ->orWhere('site_url', 'like', "%{$keyword_item}%")
                        ->orWhere('memo', 'like', "%{$keyword_item}%")
                        ->orWhereHas('tags', function ($query) use ($keyword_item) {
                            $query->where('name', 'like', "%{$keyword_item}%");
                        });
                }
            });
        }

        $clients = $query->get();

        return $clients;
    }
}
