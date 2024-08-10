<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    use HasFactory;


    protected $table = "user_points";
    protected $primaryKey = "id";
    protected $fillable = [
        'user_id',
        'points'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function students(){
        return $this->belongsTo(Student::class,'user_id','user_id');
    }
}
