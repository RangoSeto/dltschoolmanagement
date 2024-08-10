<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    use HasFactory;



    protected $table = 'townships';
    protected $primarykey = "id";
    protected $fillable = [
        'name',
        'slug',
        'country_id',
        'city_id',
        'region_id',
        'status_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }
}
