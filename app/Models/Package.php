<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;


    protected $table = "packages";
    protected $primarykey = 'id';

    protected $fillable = [
        'name',
        'price',
        'duration'
    ];

}

