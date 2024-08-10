<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pageview extends Model
{
    use HasFactory;

    protected $table = "pageviews";
    protected $primaryKey = "id";
    protected $fillable = [
        'pageurl',
        'counter'
    ];
}
