<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('id','asc')->paginate(10);
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('tags.index',compact('tags','statuses'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:50|unique:tags',
            'status_id' => 'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $tag = new Tag();
        $tag->name = $request['name'];
        $tag->slug = Str::slug($request['name']);
        $tag->status_id = $request['status_id'];
        $tag->user_id = $user_id;

        $tag->save();
        return redirect(route('tags.index'));
    }

    public function update(Request $request, string $id)
    {

        $this->validate($request,[
            'name' => 'required|max:50|unique:tags,name,'.$id,
            'status_id' => 'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $tag = Tag::findOrFail($id);
        $tag->name = $request['name'];
        $tag->slug = Str::slug($request['name']);
        $tag->status_id = $request['status_id'];
        $tag->user_id = $user_id;

        $tag->save();
        return redirect(route('tags.index'));
    }

    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->back();
    }


    public function tagstatus(Request $request){
        $tag = Tag::findOrFail($request['id']);
        $tag->status_id = $request['status_id'];
        $tag->save();

        return response()->json(["success"=>"Status Change Successfully."]);
    }


    public function bulkdeletes(Request $request)
    {

        try{
            $getselectedids = $request->selectedids;
            Tag::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }
    
}
