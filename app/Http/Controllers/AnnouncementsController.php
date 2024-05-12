<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;


use App\Models\Announcement;
use App\Notifications\AnnouncementNotify;
use App\Models\Day;
use App\Models\Dayable;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Status;
use App\Models\Tag;
use App\Models\Type;
use App\Models\User;



class AnnouncementsController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('announcements.index',compact('announcements'));
    }

    public function create()
    {
        $posts = \DB::table('posts')->where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        return view('announcements.create',compact('posts'));
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'image' => 'image|mimes:jpg,jpeg,png|max:1024',
            'title' => 'required|max:100',
            'content' => 'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $announcement = new Announcement();
        $announcement->title = $request['title'];
        $announcement->post_id = $request['post_id'];
        $announcement->content = $request['content'];
        $announcement->user_id = $user_id;

        //Single Image Upload
        if(file_exists($request['image'])){
            $file = $request['image'];
            $fname = $file->getClientOriginalName();
            $imagenewname = uniqid($user_id).$announcement['id'].$fname;
            $file->move(public_path('assets/img/announcements/'),$imagenewname);

            $filepath = 'assets/img/announcements/'. $imagenewname;
            $announcement->image = $filepath;
        }

        $announcement->save();

        // $users = User::where('id','!=',$user_id)->get();
        $users = User::where('id','!=',auth()->user()->id)->get();
        Notification::send($users,new AnnouncementNotify($announcement->id,$announcement->title,$announcement->image));

        session()->flash('success',"New Announcement Created");
        return redirect(route('announcements.index'));
    }

    public function show(string $id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $announcement = Announcement::findOrFail($id);
        $comments = $announcement->comments()->orderBy('updated_at','desc')->get();

        $type = "App\Notifications\AnnouncementNotify";
        $getnoti = \DB::table('notifications')->where('notifiable_id',$user_id)->where('type',$type)->where('data->id',$id)->get();
        DB::table('notifications')->where('id',$getnoti)->update(['read_at'=>now()]);

        return view('announcements.show',["announcement"=>$announcement,"comments"=>$comments]);
    }

    public function edit(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        $posts = \DB::table('posts')->where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');

        return view('announcements.edit')->with('announcement',$announcement)->with('posts',$posts);
    }

    public function update(Request $request, string $id)
    {

        $this->validate($request,[
            'image' => 'image|mimes:jpg,jpeg,png|max:1024',
            'title' => 'required|max:100',
            'content' => 'required',
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $announcement = Announcement::findOrFail($id);
        $announcement->title = $request['title'];
        $announcement->post_id = $request['post_id'];
        $announcement->content = $request['content'];
        $announcement->user_id = $user_id;

        // Remove Old Image
        if($request->hasFile('image')){
            $path = $announcement->image;

            if(File::exists($path)){
                File::delete($path);
            }
        }


        //Single Image Update
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fname = $file->getClientOriginalName();
            $imagenewname = uniqid($user_id).$announcement['id'].$fname;
            $file->move(public_path('assets/img/announcements/'),$imagenewname);

            $filepath = 'assets/img/announcements/'. $imagenewname;
            $announcement->image = $filepath;
        }

        $announcement->save();

        session()->flash('success','Update Successfully');
        return redirect(route('announcements.index'));
    }

    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);

        // Remove Old Image
        $path = $announcement->image;
        if(File::exists($path)){
            File::delete($path);
        }

        $announcement->delete();
        return redirect()->back();
    }


    public function bulkdeletes(Request $request)
    {

        try{
            $getselectedids = $request->selectedids;
            Announcement::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }
}
