<?php

namespace App\Http\Controllers;

use App\Mail\StudentMailBox;
use App\Models\Student;
use App\Models\Enroll;
use App\Mail\MailBox;
use App\Jobs\MailBoxJob;
use App\Jobs\StudentMailBoxJob;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class StudentsController extends Controller
{
    
    public function index()
    {
        $students = Student::all();
        return view('students.index',compact('students'));
    }

    
    public function create()
    {
        return view('students.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request,[
            // 'regnumber' => 'required|unique:students,regnumber',
            'firstname' => 'required',
            'lastname' => 'required',
            'remark' => 'max:1000'
        ],[
            'regnumber.required'=>"Register Number is required"
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        $student = new Student();
        // $student->regnumber = $request['regnumber'];
        $student->firstname = $request['firstname'];
        $student->lastname = $request['lastname'];
        $student->slug = Str::slug($request['firstname']);
        $student->remark = $request['remark'];
        $student->user_id = $user_id;
        
        $student->save();
        return redirect(route('students.index'));
    }

    
    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        $enrolls = $student->enrolls();
        return view('students.show',["student"=>$student,"enrolls"=>$enrolls]);
    }

    
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit')->with('student',$student);
    }

   
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'regnumber' => 'required|unique:students,regnumber,'.$id, // ဒီလိုရေးလိုက်တာက ဒီidကိုတော့ပြန်ရေးလို့ရတယ် ကျန်တာတေွထပ်လို့မရဘူး
            'firstname' => 'required',
            'lastname' => 'required',
            'remark' => 'max:1000'
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $student = Student::findOrFail($id);
        $student->regnumber = $request['regnumber'];
        $student->firstname = $request['firstname'];
        $student->lastname = $request['lastname'];
        $student->slug = Str::slug($request['firstname']);
        $student->remark = $request['remark'];
        $student->user_id = $user_id;
        
        $student->save();
        return redirect(route('students.index'));
    }

    
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->back();
    }

    public function mailbox(Request $request){
        // dd($request['cmpcontent']);

        // => Method 1 ( to MailBox )
        $to = $request['cmpemail'];
        $subject = $request['cmpsubject'];
        $content = $request['cmpcontent'];

        // Mail::to($to)->send(new MailBox($subject,$content));
        // Mail::to($to)->cc("admin@dlt.com")->send(new MailBox($subject,$content));
        // Mail::to($to)->cc("admin@dlt.com")->bcc("info@dlt.com")->send(new MailBox($subject,$content));


        // =>Using Job Method 1 (to MailBox)
        // dispatch(new MailBoxJob($to,$subject,$content));


        // => Method 1 ( to MailBox )
        // $data["to"] = $request['cmpemail'];
        // $data["subject"] = $request['cmpsubject'];
        // $data["content"] = $request['cmpcontent'];

        $data = [
            "to" => $request['cmpemail'],
            "subject" => $request['cmpsubject'],
            "content" => $request['cmpcontent'],
        ];

        // Mail::to($data['to'])->send(new StudentMailBox($data));
        dispatch(new StudentMailBoxJob($data));

        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            Student::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }
    }



    public function quicksearch(Request $request){

        $students = "";

        if($request->keyword != ""){
            // $students = Student::all();
            $students = Student::where("regnumber","LIKE",'%'.$request->keyword.'%')->get();
        }

        return response()->json(['datas'=>$students]);

    }


}
