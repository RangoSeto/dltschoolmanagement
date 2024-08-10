<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;


    protected $table = "carts";
    protected $primaryKey = "id";
    protected $fillable = [
        'user_id',
        'package_id',
        'quantity',
        'price'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function package(){
        return $this->belongsTo(Package::class);
    }

}
