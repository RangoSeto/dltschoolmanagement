<?php

namespace App\Http\Controllers;

use App\Models\Relative;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class RelativesController extends Controller
{

    public function index()
    {
//        $relatives = Relative::all();

        $relatives = Relative::where(function($query){
            if($getname = request('filtername')){
                $query->where('name',"LIKE",'%'.$getname.'%');
            }
        })->get();

        $statuses = Status::whereIn('id',[3,4])->get();
        return view('relatives.index',compact('relatives','statuses'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:50|unique:relatives,name',
            'status_id' => 'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $relative = new Relative();
        $relative->name = $request['name'];
        $relative->slug = Str::slug($request['name']);
        $relative->status_id = $request['status_id'];
        $relative->user_id = $user_id;

        $relative->save();
        return redirect(route('relatives.index'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|max:50|unique:relatives,name,'.$id,
            'status_id' => 'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $relative = Relative::findOrFail($id);
        $relative->name = $request['name'];
        $relative->slug = Str::slug($request['name']);
        $relative->status_id = $request['status_id'];
        $relative->user_id = $user_id;

        $relative->save();
        return redirect(route('relatives.index'));
    }

    public function destroy(string $id)
    {
        $relative = Relative::findOrFail($id);
        $relative->delete();
        session()->flash('info','Delete Successfully');
        return redirect()->back();
    }

    public function relativestatus(Request $request){
        $relative = Relative::findOrFail($request['id']);
        $relative->status_id = $request['status_id'];
        $relative->save();

        return response()->json(["success"=>"Status Change Successfully"]);
    }

    public function bulkdeletes(Request $request)
    {

        try{
            $getselectedids = $request->selectedids;
            Relative::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }
}
