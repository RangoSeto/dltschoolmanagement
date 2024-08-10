<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointsTransfer extends Model
{
    use HasFactory;


    protected $table = "points_transfers";
    protected $primarykey = 'id';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'points'
    ];

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id');
    }
}
