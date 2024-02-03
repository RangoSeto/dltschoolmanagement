<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;


    protected $table = 'roles';
    protected $primarykey = "id";
    protected $fillable = [
        'image',
        'name',
        'slug',
        'status_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function status(){
        return $this->belongsTo(Status::class);
    }
}
