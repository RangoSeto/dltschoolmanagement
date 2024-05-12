<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Attcodegenerator;
use App\Models\Post;
use App\Models\Status;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;

class AttcodegeneratorsController extends Controller
{
    public function index()
    {
        $attcodegenerators = Attcodegenerator::orderBy('created_at','desc')->get();
        // $posts = Post::where('attshow',3)->get();
        $posts = DB::table('posts')->where('attshow',3)->orderBy('title','asc')->get(); //beware :: {{$post['id']}} array can't .must be call by object in view file . such as {{$post->id}}
        $statuses = Status::whereIn('id',[3,4])->get();
        // $gettoday = date('Y-m-d',strtotime(Carbon::today()));
        $gettoday = Carbon::today()->format('Y-m-d');
        // dd($getoday);
        return view('attcodegenerators.index',compact('attcodegenerators','posts','statuses','gettoday'));
    }



    public function store(Request $request)
    {
        $this->validate($request,[
            'classdate' => 'required|date',
            'post_id'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $attcodegenerator = new Attcodegenerator();
        $attcodegenerator->classdate = $request['classdate'];
        $attcodegenerator->post_id = $request['post_id'];
        $attcodegenerator->attcode = is_null($request['attcode']) ? $attcodegenerator->randomstringgenerator(4) : Str::upper($request['attcode']);
        $attcodegenerator->status_id = $request['status_id'];
        $attcodegenerator->user_id = $user_id;

        $attcodegenerator->save();

        session()->flash('success',"Att Code Created");
        return redirect(route('attcodegenerators.index'));
    }


    public function typestatus(Request $request){
        $attcodegenerator = Attcodegenerator::findOrFail($request['id']);
        $attcodegenerator->status_id = $request['status_id'];
        $attcodegenerator->save();

        return response()->json(['success'=>"Status Change Successfully."]);
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            Attcodegenerator::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }
    }

}
