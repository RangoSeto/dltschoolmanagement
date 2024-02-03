<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $primarykey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
