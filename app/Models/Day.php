<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $table = 'days';
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'slug',
        'status_id',
        'user_id'
    ];

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->morphedByMany(Post::class,'dayable');
    }
}
