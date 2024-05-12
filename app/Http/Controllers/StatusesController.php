<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;

use Illuminate\Http\Request;

class StatusesController extends Controller
{
    
    public function index()
    {
        $statuses = Status::all();
        return view('statuses.index',compact('statuses'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:statuses,name'
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $status = new Status();
        $status->name = $request['name'];
        $status->slug = Str::slug($request['name']);
        $status->user_id = $user_id;
        
        $status->save();
        return redirect(route('statuses.index'));
    }

    
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|unique:statuses,name,'.$id
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $status = Status::findOrFail($id);
        $status->name = $request['name'];
        $status->slug = Str::slug($request['name']);
        $status->user_id = $user_id;
        
        $status->save();
        return redirect(route('statuses.index'));
    }

    
    public function destroy(string $id)
    {
        $status = Status::findOrFail($id);
        $status->delete();
        return redirect()->back();
    }


    public function bulkdeletes(Request $request)
    {

        try{
            $getselectedids = $request->selectedids;
            Status::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }
}
