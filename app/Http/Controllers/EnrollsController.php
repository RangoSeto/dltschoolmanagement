<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Models\Stage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class EnrollsController extends Controller
{
    
    public function index()
    {
        $enrolls = Enroll::orderBy('updated_at','desc')->get();
        $stages = Stage::whereIn('id',[1,2,3])->get();
        $posts = DB::table('posts')->where('attshow',3)->orderBy('title','asc')->get(); // beware:: {{$post['id']}} array can't .must be call by object in view file such as ,{{$post->id}}
        return view('enrolls.index',compact('enrolls','stages','posts'));
    }

    public function create()
    {
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('enrolls.create',compact('statuses'));
    }

    public function store(Request $request)
    {
        
        $this->validate($request,[
            'image' => 'image|mimes:jpg,jpeg,png|max:1024',
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $enroll = new Enroll();
        $enroll->post_id = $request['post_id'];
        $enroll->remark = $request['remark'];
        $enroll->user_id = $user_id;

        //Single Image Upload
        if(file_exists($request['image'])){
            $file = $request['image'];
            $fname = $file->getClientOriginalName();
            $imagenewname = uniqid($user_id).$enroll['id'].$fname;
            $file->move(public_path('assets/img/enrolls/'),$imagenewname);

            $filepath = 'assets/img/enrolls/'. $imagenewname;
            $enroll->image = $filepath;
        }
        
        $enroll->save();
        return redirect()->back();
    }

    public function show(string $id)
    {
        $enroll = Enroll::findOrFail($id);
        return view('enrolls.show',["enroll"=>$enroll]);
    }

    public function edit(string $id)
    {
        $enroll = Enroll::findOrFail($id);
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('enrolls.edit')->with('enroll',$enroll)->with('statuses',$statuses);
    }

    public function update(Request $request, string $id)
    {

        // dd($request->all());
        
        $this->validate($request,[
            'stage_id' => ['required','in:1,2,3'],
            'remark' => ['max:4000']
        ]);

        $enroll = Enroll::findOrFail($id);
        $enroll->stage_id = $request['stage_id'];
        $enroll->remark = $request['remark'];

        // // Remove Old Image
        // if($request->hasFile('image')){
        //     $path = $enroll->image;

        //     if(File::exists($path)){
        //         File::delete($path);
        //     }
        // }


        // //Single Image Update
        // if($request->hasFile('image')){
        //     $file = $request->file('image');
        //     $fname = $file->getClientOriginalName();
        //     $imagenewname = uniqid($user_id).$enroll['id'].$fname;
        //     $file->move(public_path('assets/img/enrolls/'),$imagenewname);

        //     $filepath = 'assets/img/enrolls/'. $imagenewname;
        //     $enroll->image = $filepath;
        // }
        
        $enroll->save();
        return redirect(route('enrolls.index'));
    }

    public function destroy(string $id)
    {
        $enroll = Enroll::findOrFail($id);

        // Remove Old Image
        $path = $enroll->image;
        if(File::exists($path)){
            File::delete($path);
        }

        $enroll->delete();
        return redirect()->back();
    }
}
