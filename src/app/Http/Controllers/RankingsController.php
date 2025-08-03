<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\RankingService;
use Illuminate\Http\Request;

class RankingsController extends Controller
{
    private RankingService $rankingService;

    public function __construct(RankingService $rankingService)
    {
        $this->rankingService = $rankingService;
    }

    /**
     * ランキング取得
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // TODO: ランキング取得ロジック
        $rankingList = $this->rankingService->getRanking();
        return $rankingList;
    }

    /**
     * スコア投稿とランキング更新
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $clientId = $request->input('clientId');
        $clearScore = $request->input('clearScore');
        $clearTime = $request->input('clearTime');

        $responseParam = $this->rankingService->postRanking($clientId, $clearScore, $clearTime);

        return response()->json([
            'isRankUp' => $responseParam['isRankUp'],
            'isHighScore' => $responseParam['isHighScore']
        ]);
    }
}
