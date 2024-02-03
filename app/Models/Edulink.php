<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edulink extends Model
{
    use HasFactory;


    protected $table = 'edulinks';
    protected $primarykey = "id";
    protected $fillable = [
        'classdate',
        'post_id',
        'url',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }


    // Define Local Scope

    // public function scope[name]($query){
    //     return $query->[method];
    // }

    public function scopezaclassdate($query){
        return $query->orderBy('classdate','desc');
    }

    public function scopefilter($query){

        if($getfilter = request('filter')){
            $query->where('post_id',$getfilter);
        }

        if($getsearch = request('search')){

            // search by class date 
            // $query->where('classdate','LIKE',"%".$getsearch."%");
            // $query->where('classdate','LIKE',"%${getsearch}%");

            // search by class date / created at / updated at
            // $query->where('classdate','LIKE',"%${getsearch}%")
            //     ->orWhere('created_at','LIKE',"%${getsearch}%")
            //     ->orWhere('updated_at','LIKE',"%${getsearch}%");

            // search by class date / created at / updated at
            // $query->where('classdate','LIKE',"%${getsearch}%");
            // $query->orWhere('created_at','LIKE',"%${getsearch}%");
            // $query->orWhere('updated_at','LIKE',"%${getsearch}%");


            // search by class date / created at / updated at / post title
            // orWhereHas(relation,callback)
            $query->where('classdate','LIKE',"%${getsearch}%")
                ->orWhere('created_at','LIKE',"%${getsearch}%")
                ->orWhere('updated_at','LIKE',"%${getsearch}%")
                ->orWhereHas('post',function($query) use($getsearch){
                    $query->where('title','LIKE',"%${getsearch}%");
                });


        }

        return $query;
    }



    public function scopefilteronly($query){

        if($getfilter = request('filter')){
            $query->where('post_id',$getfilter);
        }

        return $query;
    }


    public function scopesearchonly($query){

        if($getsearch = request('search')){

            // search by class date / created at / updated at / post title
            // orWhereHas(relation,callback)
            $query->where('classdate','LIKE',"%${getsearch}%")
                ->orWhere('created_at','LIKE',"%${getsearch}%")
                ->orWhere('updated_at','LIKE',"%${getsearch}%")
                ->orWhereHas('post',function($query) use($getsearch){
                    $query->where('title','LIKE',"%${getsearch}%");
                });

        }

        return $query;
    }


}
