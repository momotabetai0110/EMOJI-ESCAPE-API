<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emoji_escape extends Model
{
    use HasFactory;

    protected $table = 'emoji_escape';
    protected $primaryKey = 'id';

    protected $fillable = [
        'client_id',
        'clear_score',
        'clear_time',
    ];

    protected $casts = [
        'clear_score' => 'integer',
        'clear_time' => 'datetime:H:i:s.v',
        'created_at' => 'datetime'
    ];

    public function getRankingList(){

    }
}


