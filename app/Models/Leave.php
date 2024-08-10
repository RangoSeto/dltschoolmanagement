<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Leave extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'leaves';
    protected $primarykey = "id";
    protected $fillable = [
        'post_id',
        'startdate',
        'enddate',
        'tag',
        'title',
        'content',
        'image',
        'stage_id',
        'authorize_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function stage(){
        return $this->belongsTo(Stage::class);
    }

    public function leavefiles(){
        return $this->hasMany(LeaveFile::class);
    }

    public function scopefilteronly($query){
        if($getfilter = request('filter')){
            $query->where('post_id',$getfilter);
        }
        return $query;
    }

    public function scopesearchonly($query){
        if($getsearch = request('search')){
            $query->where('startdate','LIKE',"%${getsearch}%")
                ->orWhere('enddate','LIKE',"%${getsearch}%")
                ->orWhere('title','LIKE',"%${getsearch}%")
                ->orWhereHas('post',function($query) use($getsearch){
                    $query->where('title','LIKE',"%${getsearch}%");
                });
        }
    }

    public function scopeazclassname($query){
        $query->orderBy('post_id','asc');
    }


    public function student($userid){

        $students = Student::where('user_id',$userid)->get()->pluck('regnumber');
        // dd($students);
        foreach($students as $student){
            // dd($student);
            return $student;
        }

    }

    public function studenturl(){
        return Student::where('user_id',$this->user_id)->get(['students.id'])->first();
    }

    public function tagperson(){
        return $this->belongsTo(User::class,'tag');
    }

    public function enrollper(){
        $enrolls = Enroll::where('user_id',$this->user_id)->get();
        return $enrolls;
    }

}
