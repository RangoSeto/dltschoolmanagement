<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Religion;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class ReligionsController extends Controller
{
    
    public function index()
    {
        //http://127.0.0.1:8000/countries?filtername=myan
        // dd(request('filtername')); //input name ထဲကဟာရဲ့dataကိုယူတာ

        $religions = Religion::where(function($query){
            if($getname = request('filtername')){
                $query->where('name',"LIKE",'%'.$getname.'%');
            }
        })->paginate(15);
        // dd($countries);

        $statuses = Status::whereIn('id',[3,4])->get();

        // $countries = Country::all();
        return view('religions.index',compact('religions','statuses'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:religions,name'
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $region = new Religion();
        $region->name = $request['name'];
        $region->status_id = $request['status_id'];
        $region->user_id = $user_id;

        $region->save();
        return redirect(route('religions.index'));
    }

    public function update(Request $request, string $id)
    {
        
        $this->validate($request,[
            'editname'=>'required|unique:religions,name,'.$id
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $region = Religion::findOrFail($id);
        $region->name = $request['editname'];
        $region->status_id = $request['editstatus_id'];
        $region->user_id = $user_id;

        $region->save();

        session()->flash('success','Update Successfully');
        return redirect(route('religions.index'));
    }

    public function destroy(string $id)
    {
        $region = Religion::findOrFail($id);
        $region->delete();
        return redirect()->back();
    }

    public function typestatus(Request $request){
        $region = Religion::findOrFail($request['id']);
        $region->status_id = $request['status_id'];
        $region->save();

        return response()->json(['success'=>"Status Change Successfully."]);
    }


    public function bulkdeletes(Request $request)
    {

        try{
            $getselectedids = $request->selectedids;
            Religion::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }
}
