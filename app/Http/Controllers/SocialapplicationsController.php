<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socialapplication;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Exception;

class SocialapplicationsController extends Controller
{
    public function index()
    {
        $socialapplications = Socialapplication::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('socialapplications.index',compact('socialapplications','statuses'));
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required|max:50|unique:socialapplications',
            'status_id' => 'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        try{
            $socialapplication = new Socialapplication();
            $socialapplication->name = $request['name'];
            $socialapplication->slug = Str::slug($request['name']);
            $socialapplication->status_id = $request['status_id'];
            $socialapplication->user_id = $user_id;

            $socialapplication->save();

            if($socialapplication){
                return response()->json(["status"=>"success","data"=>$socialapplication]);
            }

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }

        
        return redirect(route('socialapplications.index'));
    }

    public function edit(string $id)
    {
        $socialapplication = Socialapplication::findOrFail($id);
        
        return response()->json($socialapplication);
    }


    public function update(Request $request, string $id)
    {

        $this->validate($request,[
            'name' => ['required','max:50','unique:socialapplications,name,'.$id],
            'status_id' => ['required','in:3,4']
        ]);
        
        $user = Auth::user();
        $user_id = $user['id'];

        try{
            $socialapplication = Socialapplication::findOrFail($id);
            $socialapplication->name = $request['name'];
            $socialapplication->slug = Str::slug($request['name']);
            $socialapplication->status_id = $request['status_id'];
            $socialapplication->user_id = $user_id;

            $socialapplication->save();

            if($socialapplication){
                return response()->json(["status"=>"success","data"=>$socialapplication]);
            }

            return response()->json(["status"=>"failed","message"=>"Failed to update Payment Method."]);

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }

        
    }

    // public function destroy(string $id)
    // {
    //     $socialapplication = Socialapplication::findOrFail($id);
    //     $socialapplication->delete();

    //     session()->flash('info','Delete Successfully');
    //     return redirect()->back();
    // }


    
    public function destroy(string $id)
    {

        try{

            $socialapplication = Socialapplication::where('id',$id)->delete();
            return Response::json($socialapplication);

            // method 1 used in paymentMethod
            // if($socialapplication){
            //     $socialapplication->delete();
            //     return response()->json(["status"=>"success","data"=>$socialapplication,"message"=>"Delete Successfully"]);
            // }

            // return response()->json(["status"=>"failed","message"=>"No Data Found"]);

        }catch(Exception $e){
            Log::error($e->getMessage()); // ဒါမထည့်လည်းရတယ် logထဲမှာသွားရေးခိုင်းလိုက်တာ
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }

    }



    public function typestatus(Request $request){
        $socialapplication = Socialapplication::findOrFail($request['id']);
        $socialapplication->status_id = $request['status_id'];
        $socialapplication->save();

        return response()->json(['success'=>"Status Change Successfully."]);
    }

    public function fetchalldatas()
    {
        try{
            $socialapplications = Socialapplication::all();
            return response()->json(['status'=>"success","data"=>$socialapplications]);
        }catch(Exception $e){
            Log::error($e->getMessage()); 
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }



    public function bulkdeletes(Request $request)
    {

        try{
            $getselectedids = $request->selectedids;
            Socialapplication::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }
}
