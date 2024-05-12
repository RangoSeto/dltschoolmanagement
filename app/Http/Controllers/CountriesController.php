<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;


class CountriesController extends Controller
{

    public function index()
    {
        //http://127.0.0.1:8000/countries?filtername=myan
        // dd(request('filtername')); //input name ထဲကဟာရဲ့dataကိုယူတာ

        $countries = Country::where(function($query){
            if($getname = request('filtername')){
                $query->where('name',"LIKE",'%'.$getname.'%');
            }
        })->paginate(10);
        // dd($countries);

        $statuses = Status::whereIn('id',[3,4])->get();

        // $countries = Country::all();
        return view('countries.index',compact('countries','statuses'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:countries,name'
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $country = new Country();
        $country->name = $request['name'];
        $country->slug = Str::slug($request['name']);
        $country->status_id = $request['status_id'];
        $country->user_id = $user_id;

        $country->save();
        return redirect(route('countries.index'));
    }

    public function update(Request $request, string $id)
    {
        
        $this->validate($request,[
            'editname'=>'required|unique:countries,name,'.$id
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $country = Country::findOrFail($id);
        $country->name = $request['editname'];
        $country->slug = Str::slug($request['editname']);
        $country->status_id = $request['editstatus_id'];
        $country->user_id = $user_id;

        $country->save();

        session()->flash('success','Update Successfully');
        return redirect(route('countries.index'));
    }

    public function destroy(string $id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return redirect()->back();
    }

    public function typestatus(Request $request){
        $country = Country::findOrFail($request['id']);
        $country->status_id = $request['status_id'];
        $country->save();

        return response()->json(['success'=>"Status Change Successfully."]);
    }


    public function bulkdeletes(Request $request)
    {

        try{
            $getselectedids = $request->selectedids;
            Country::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }
}
