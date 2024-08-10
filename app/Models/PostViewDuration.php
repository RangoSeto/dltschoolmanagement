<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostViewDuration extends Model
{
    use HasFactory;



    protected $table = 'post_view_durations';
    protected $primarykey = "id";
    protected $fillable = [
        'user_id',
        'post_id',
        'duration',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    
}
