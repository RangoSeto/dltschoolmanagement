<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'contacts';
    protected $primarykey = "id";
    protected $fillable = [
        'firstname',
        'lastname',
        'birthday',
        'relative_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function relative(){
        return $this->belongsTo(Relative::class);
    }

    public function scopefilteronly($query){

        if($getfilter = request('filter')){
            $query->where('relative_id',$getfilter);
        }

        return $query;
    }


    public function scopesearchonly($query){

        if($getsearch = request('search')){

            // search by firstname /lastname / birthday / relative name
            // orWhereHas(relation,callback)
            $query->where('firstname','LIKE',"%${getsearch}%")
                ->orWhere('lastname','LIKE',"%${getsearch}%")
                ->orWhere('birthday','LIKE',"%${getsearch}%")
                ->orWhereHas('relative',function($query) use($getsearch){
                    $query->where('name','LIKE',"%${getsearch}%");
                });

        }

        return $query;
    }

    public function scopezafirstname($query){
        return $query->orderBy('firstname','asc');
    }

}
