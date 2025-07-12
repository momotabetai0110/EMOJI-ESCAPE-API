<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class emoji_escape extends Model
{
    use HasFactory;

    protected $table = 'emoji_escape';
    protected $primaryKey = 'id';
    public $timestamps = false; // created_atとupdated_atを無効化

    protected $fillable = [
        'client_id',
        'clear_score',
        'clear_time',
        'created_at'
    ];

    protected $casts = [
        'clear_score' => 'integer',
        'clear_time' => 'datetime:H:i:s.v'
    ];

    /**
     * クライアントIDを指定してランキングを取得
     * @param int $clientId
     * @return int
     */
    public function getRankByClientId($clientId){
        $rankArray = $this->select(DB::raw('MAX(clear_score) as max_score'), 'client_id')
            ->groupBy('client_id')
            ->orderBy('max_score', 'desc')
            ->get();

        $rank = $rankArray->search(function($item) use ($clientId) {
            return $item->client_id == $clientId;
        });

        return $rank+1;
    }

}


