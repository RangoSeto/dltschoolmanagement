<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Enroll extends Model
{
    use HasFactory;

    protected $table = 'enrolls';
    protected $primarykey = "id";
    protected $fillable = [
        'image',
        'post_id',
        'user_id',
        'stage_id',
        'remark'
    ];

    public function stage(){
        return $this->belongsTo(Stage::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    // public function student($userid){
    public function student(){

        // Method 1
        // $students = Student::where('user_id',$userid)->get();
        // dd($students);
        // foreach($students as $student){
        //     // dd($student);
        //     // dd($student["regnumber"]);
        //     return $student["regnumber"];
        // }


        // Method 2
        // $students = Student::where('user_id',$userid)->get()->pluck('regnumber');
        // // dd($students);
        // foreach($students as $student){
        //     // dd($student);
        //     return $student;
        // }

        // Method 3
        // $students = Student::where('user_id',$this->user_id)->get();
        // dd($students);
        // foreach($students as $student){
        //     // dd($student);
        //     // dd($student["regnumber"]);
        //     return $student["regnumber"];
        // }


        // Method 4
        // $students = Student::where('user_id',$this->user_id)->get()->pluck('regnumber');
        // // dd($students);
        // foreach($students as $student){
        //     // dd($student);
        //     return $student;
        // }


        // Method 5
                                // sec table,sec table prikey,compare,pri table fk key
        // $students = Student::join('users','users.id','=','students.user_id')->where('user_id',$this->user_id)->get();
        // // dd($students);
        // foreach($students as $student){
        //     // dd($student["regnumber"]);
        //     return $student["regnumber"];
        // }


        // Method 6
                                // sec table,sec table prikey,compare,pri table fk key
        // $students = Student::join('users','users.id','=','students.user_id')->where('user_id',$this->user_id)->get()->pluck('regnumber');
        // // dd($students);
        // foreach($students as $student){
        //     // dd($student);
        //     return $student;
        // }



        // Method 7
                                // sec table,sec table prikey,compare,pri table fk key
        // $students = Student::join('users','users.id','=','students.user_id')->where('user_id',$this->user_id)->get(['users.*','students.*']);
        // // dd($students);
        // foreach($students as $student){
        //     // dd($student["regnumber"]);
        //     return $student["regnumber"];
        // }


        // Method 8
                                // sec table,sec table prikey,compare,pri table fk key
        // $students = Student::join('users','users.id','=','students.user_id')->where('user_id',$this->user_id)->get(['users.name','students.regnumber'])->first();
        // // dd($students);
        // // dd($students["regnumber]);
        // return $students["regnumber"];


        // Method 9
                                // sec table,sec table prikey,compare,pri table fk key
        // $students = Student::join('users','users.id','=','students.user_id')->where('user_id',$this->user_id)->get(['users.name','students.regnumber'])->pluck('regnumber')->first();
        // // dd($students);
        // // dd($students);
        // return $students;


        // Method 10
        // $students = DB::table('students')
        //             ->join('users','users.id','=','students.user_id')
        //             ->where('user_id',$this->user_id)
        //             ->get(['users.name','students.regnumber'])
        //             ->pluck('regnumber')->first();

        // // dd($students);
        // return $students;


        // Method 11
        $students = DB::table('students')
                    ->select('users.id','users.name','students.regnumber')
                    ->join('users','users.id','=','students.user_id')
                    ->where('user_id',$this->user_id)
                    ->get()
                    ->pluck('regnumber')->first();

        // dd($students);
        return $students;

    }


    public function studenturl(){
        return Student::where('user_id',$this->user_id)->get(['students.id'])->first();
    }

}
