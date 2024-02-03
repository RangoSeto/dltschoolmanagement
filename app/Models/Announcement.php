<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Announcement extends Model
{
    use HasFactory,Notifiable;


    protected $table = "announcements";
    protected $primaryKey = "id";
    protected $fillable = [
        'image',
        'title',
        'content',
        'post_id',
        'user_id'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }
}
