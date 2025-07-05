<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ClientIdController extends Controller
{
    /**
     * ランダムな6桁の文字列(数字)を返すPOSTメソッド
     */
    public function store()
    {
        $userNum = collect(range(6, 9))
            ->random(1)
            ->implode('');

        $randomNum = collect(range(0, 9))
            ->random(5)
            ->implode('');

        $clientId = $userNum.$randomNum;

        return response()->json(['clientId' => $clientId]);
    }
}
