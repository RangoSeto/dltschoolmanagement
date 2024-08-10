<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointTransferHistory extends Model
{
    use HasFactory;


    protected $table = "point_transfer_histories";
    protected $primarykey = 'id';

    protected $fillable = [
        'points_transfers_id',
        'user_id',
        'accounttype',
        'points'
    ];

    public function students(){
        return $this->belongsTo(Student::class,'user_id','user_id');
    }
}
