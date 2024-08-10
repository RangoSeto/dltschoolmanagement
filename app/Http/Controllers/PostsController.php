<?php

namespace App\Http\Controllers;

use App\Models\PostViewDuration;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;

use App\Models\Day;
use App\Models\Dayable;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Status;
use App\Models\Tag;
use App\Models\Type;


class PostsController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }

    public function create()
    {
        $attshows = Status::whereIn('id',[3,4])->get();
        $days = Day::where('status_id',3)->get();
        $statuses = Status::whereIn('id',[7,10,11])->get();
        $tags = Tag::where('status_id',3)->get();
        $types = Type::whereIn('id',[1,2])->get();
        return view('posts.create',compact('attshows','days','statuses','tags','types'));
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'image' => 'image|mimes:jpg,jpeg,png|max:1024',
            'title' => 'required|max:300|unique:posts,title',
            'content' => 'required',
            'fee' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'starttime' => 'required',
            'endtime' => 'required',
            'type_id' => 'required|in:1,2',
            'tag_id' => 'required',
            'attshow' => 'required|in:3,4',
            'status_id' => 'required|in:7,10,11'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $post = new Post();
        $post->title = $request['title'];
        $post->slug = Str::slug($request['title']);
        $post->content = $request['content'];
        $post->fee = $request['fee'];
        $post->startdate = $request['startdate'];
        $post->enddate = $request['enddate'];
        $post->starttime = $request['starttime'];
        $post->endtime = $request['endtime'];
        $post->type_id = $request['type_id'];
        $post->tag_id = $request['tag_id'];
        $post->attshow = $request['attshow'];
        $post->status_id = $request['status_id'];
        $post->user_id = $user_id;

        //Single Image Upload
        if(file_exists($request['image'])){
            $file = $request['image'];
            $fname = $file->getClientOriginalName();
            $imagenewname = uniqid($user_id).$post['id'].$fname;
            $file->move(public_path('assets/img/posts/'),$imagenewname);

            $filepath = 'assets/img/posts/'. $imagenewname;
            $post->image = $filepath;
        }

        $post->save();


        if($post->id){

            // dd($request['day_id']);

            // create dayable

            // Method 1
            // if(count($request['day_id']) > 0){

            //     foreach($request['day_id'] as $key=>$value){
            //         Dayable::create([
            //             // 'day_id'=>$request['day_id'][$key],
            //             'day_id'=>$value,
            //             'dayable_id'=>$post->id,
            //             'dayable_type'=>$request['dayable_type']
            //         ]);
            //     }

            // }


            // Method 2
            if(count($request['day_id']) > 0){

                foreach($request['day_id'] as $key=>$value){

                    $day = [
                        // 'day_id'=>$request['day_id'][$key],
                        'day_id'=>$value,
                        'dayable_id'=>$post->id,
                        'dayable_type'=>$request['dayable_type']
                    ];

                    Dayable::insert($day);

                }

            }

        }

        session()->flash('success',"New Post Created");
        return redirect(route('posts.index'));
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        // dd($post->checkenroll(1));

        $dayables = $post->days()->get();
        // $comments = Comment::where('commentable_id',$post->id)->where('commentable_type','App\Models\Post')->orderBy('created_at','desc')->get();
        $comments = $post->comments()->orderBy('updated_at','desc')->get();

        // $postviewdurations = PostViewDuration::where('post_id',$id)->get();
        $user_id = Auth::user()->id;
        $postviewdurations = $post->postviewdurations()->whereNot('user_id',$user_id)->orderBy('id','desc')->take('10')->get();

//        dd($postviewdurations);
        return view('posts.show',["post"=>$post,'dayables'=>$dayables,'comments'=>$comments,'postviewdurations'=>$postviewdurations]);
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        // dd($post);
        $attshows = Status::whereIn('id',[3,4])->get();
        $days = Day::where('status_id',3)->get();
        $dayables = $post->days()->get();
        // dd($dayables);
        $statuses = Status::whereIn('id',[7,10,11])->get();
        $tags = Tag::where('status_id',3)->get();
        $types = Type::whereIn('id',[1,2])->get();
        return view('posts.edit')->with('post',$post)->with('attshows',$attshows)->with('days',$days)->with('dayables',$dayables)->with('statuses',$statuses)->with('tags',$tags)->with('types',$types);
    }

    public function update(Request $request, string $id)
    {

        $this->validate($request,[
            'image' => 'image|mimes:jpg,jpeg,png|max:1024',
            'title' => 'required|max:300|unique:posts,title,'.$id,
            'content' => 'required',
            'fee' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'starttime' => 'required',
            'endtime' => 'required',
            'type_id' => 'required|in:1,2',
            'tag_id' => 'required',
            'attshow' => 'required|in:3,4',
            'status_id' => 'required|in:7,10,11'
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $post = Post::findOrFail($id);
        $post->title = $request['title'];
        $post->slug = Str::slug($request['title']);
        $post->content = $request['content'];
        $post->fee = $request['fee'];
        $post->startdate = $request['startdate'];
        $post->enddate = $request['enddate'];
        $post->starttime = $request['starttime'];
        $post->endtime = $request['endtime'];
        $post->type_id = $request['type_id'];
        $post->tag_id = $request['tag_id'];
        $post->attshow = $request['attshow'];
        $post->status_id = $request['status_id'];
        $post->user_id = $user_id;

        // Remove Old Image
        if($request->hasFile('image')){
            $path = $post->image;

            if(File::exists($path)){
                File::delete($path);
            }
        }


        //Single Image Update
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fname = $file->getClientOriginalName();
            $imagenewname = uniqid($user_id).$post['id'].$fname;
            $file->move(public_path('assets/img/posts/'),$imagenewname);

            $filepath = 'assets/img/posts/'. $imagenewname;
            $post->image = $filepath;
        }

        $post->save();

        // Start Day Action

        // Method 1
        //  if(count($request['day_id']) > 0){
        //      $post->days()->detach();

        //      foreach($request['day_id'] as $key=>$value){

        //          Dayable::create([
        //              'day_id'=>$value,
        //              'dayable_id'=>$post->id,
        //              'dayable_type'=>$request['dayable_type']
        //          ]);
        //      }
        //  }


        // Method 2
        if(isset($request['newday_id'])){

            // remove all days
            foreach($request['newday_id'] as $key=>$value){
                $dayable = Dayable::where('dayable_id',$post['id'])->where('dayable_type',$request['dayable_type']);
                $dayable->delete();
            }

            // add  renewday
            foreach($request['newday_id'] as $key=>$value){

                $renewday = [
                    'day_id'=>$request['newday_id'][$key],
                    'dayable_id'=>$post['id'],
                    'dayable_type'=>$request['dayable_type']
                ];

                Dayable::insert($renewday);

            }

        }


        // End Day Action


        return redirect(route('posts.index'));
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // Remove Old Image
        $path = $post->image;
        if(File::exists($path)){
            File::delete($path);
        }

        $post->delete();
        return redirect()->back();
    }


    public function bulkdeletes(Request $request)
    {

        try{
            $getselectedids = $request->selectedids;
            Day::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }
}

