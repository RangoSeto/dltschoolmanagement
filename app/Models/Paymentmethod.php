<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymentmethod extends Model
{
    use HasFactory;

    protected $table = "paymentmethods";
    protected $primaryKey = "id";
    protected $fillable = [
        'image',
        'name',
        'slug',
        'paymenttype_id',
        'status_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function paymenttype(){
        return $this->belongsTo(Paymenttype::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
