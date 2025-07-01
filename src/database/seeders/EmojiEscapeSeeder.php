<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\emoji_escape;

class EmojiEscapeSeeder extends Seeder
{
    /**
     * データベースシードを実行
     *
     * @return void
     */
    public function run()
    {
        $emojiEscape = new emoji_escape();
        for ($i = 1; $i < 6; $i++) {
            // テスト用クライアントIDを生成
            $randomNum = collect(range(0, 9))
                ->random(5)
                ->implode('');
            $clientId = $i . $randomNum;

            for ($j = 1; $j < 4; $j++) {
                $insertData = [
                    'client_id' => $clientId,
                    'clear_score' => $i . $j . '0', //3桁のスコア
                    'clear_time' => '00:00:10.' . $i . $j, //10秒+ミリ秒
                ];
                $emojiEscape->insert($insertData);
            }
        }
    }
}
