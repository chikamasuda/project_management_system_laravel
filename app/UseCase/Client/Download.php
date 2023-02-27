<?php

namespace App\UseCase\Client;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Download
{
    /**
     * CSVダウンロードデータ作成
     *
     * @param Request $request
     * @return void
     */
    public function invoke(Request $request)
    {
        //CSVの1行目にタイトルを入れる
        $csvHeader = ['ID', 'クライアント名', 'Eメール', '住所', 'ステータス', 'サイトURL', 'メモ'];
        $timestamp = Carbon::now()->format('ymdhis');
        //ダウンロードファイル名
        $name = "顧客一覧_" . $timestamp . ".csv";
        $keyword = $request->keyword;

        $keyword = $request->keyword;

        $lists = self::getSearchData($keyword);

        //ダウンロードデータを配列に入れて変数$dataに代入
        $data = self::getDownloadData($lists);

        //CSV作成
        $csv = self::baseCSV($data, $csvHeader, $name);

        return $csv;
    }

    /**
     * CSV作成の共通項目を別ファンクションにした
     * @param $data
     * @param $csvHeader
     * @param $name
     * @return array
     */
    private static function baseCSV($data, $csvHeader, $name): array
    {
        array_unshift($data, $csvHeader);
        $stream = fopen('php://temp', 'r+b');
        foreach ($data as $d) {
            fputcsv($stream, $d);
        }
        rewind($stream);
        $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
        $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $name,
        ];

        return ['csv' => $csv, 'headers' => $headers];
    }

    /**
     * ダウンロードされる配列データ
     *
     * @param object $lists
     * @return array
     */
    private static function getDownloadData($lists): array
    {
        foreach ($lists as $list) {
            //この配列がダウンロードされるデータになる
            $arrayData['id']         = $list->id;
            $arrayData['name']       = $list->name;
            $arrayData['email']      = $list->email;
            $arrayData['address']    = $list->address;
            $arrayData['status']     = Client::STATUS[$list->status];
            $arrayData['site_url']   = $list->site_url;
            $arrayData['memo']       = $list->memo;
            //上記をまとめてデータ化。
            $data[] = array_values($arrayData);
        }
        return $data;
    }

    /**
     * 検索結果データ取得
     *
     * @param  string $keyword
     * @return object
     */
    private static function getSearchData(string $keyword = null): object
    {
        $query = Client::with('tags')
            ->where('user_id', auth()->user()->id);

        //検索データ取得
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

        $lists = $query->get();

        return $lists;
    }
}
