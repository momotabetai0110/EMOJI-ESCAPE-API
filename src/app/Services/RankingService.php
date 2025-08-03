<?php

namespace App\Services;

use App\Models\emoji_escape;

use function Laravel\Prompts\clear;

class RankingService
{
    private emoji_escape $emojiEscape;

    public function __construct(emoji_escape $emojiEscape)
    {
        $this->emojiEscape = $emojiEscape;
    }

    /**
     * ランキング取得
     * @return array
     */
    public function getRanking()
    {
        $rankingList = $this->emojiEscape->orderBy('clear_score', 'desc')->select('client_id', 'clear_score', 'clear_time')->get();

        return $rankingList;
    }

    /**
     * クリアデータのインサートとランキング更新チェック
     * @param int $clientId
     * @param int $clearScore
     * @param int $clearTime
     * @return array
     */
    public function postRanking($clientId, $clearScore, $clearTime)
    {
        //ハイスコア更新チェック
        $currentHighScore = $this->emojiEscape->where('client_id', $clientId)->orderBy('clear_score', 'desc')->value('clear_score');

        $isUpdateHighScore = ($currentHighScore < $clearScore) ? 1 : 0;

        //スコア更新前ランキング取得
        $currentRank = $this->emojiEscape->getRankByClientId($clientId);

        //スコアインサート
        $this->emojiEscape->create([
            'client_id' => $clientId,
            'clear_score' => $clearScore,
            'clear_time' => $clearTime,
            'created_at' => now()
        ]);

        //ランキング更新チェック
        $updatedRank = $this->emojiEscape->getRankByClientId($clientId);

        $isRankUp = ($currentRank > $updatedRank) ? $updatedRank : 0;

        return ['isRankUp' => $isRankUp, 'isHighScore' => $isUpdateHighScore];
    }
}
