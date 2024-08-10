<?php

namespace App\Http\Controllers;


use App\Models\Country;
use App\Models\City;
use App\Models\Region;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Exception;

class RegionsController extends Controller
{
    
    public function index()
    {
        //http://127.0.0.1:8000/countries?filtername=myan
        // dd(request('filtername')); //input name ထဲကဟာရဲ့dataကိုယူတာ

        $regions = Region::where(function($query){
            if($getname = request('filtername')){
                $query->where('name',"LIKE",'%'.$getname.'%');
            }
        })->paginate(15);
        // dd($countries);

        $countries = Country::orderBy('name','asc')->where('status_id',3)->get();
        $cities = City::orderBy('name','asc')->where('status_id',3)->get();
        $statuses = Status::whereIn('id',[3,4])->get();

        // $countries = Country::all();
        return view('regions.index',compact('regions','countries','cities','statuses'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'country_id'=>'required',
            'city_id'=>'required',
            'name'=>'required|unique:regions,name'
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $region = new Region();
        $region->name = $request['name'];
        $region->slug = Str::slug($request['name']);
        $region->country_id = $request['country_id'];
        $region->city_id = $request['city_id'];
        $region->status_id = $request['status_id'];
        $region->user_id = $user_id;

        $region->save();
        return redirect(route('regions.index'));
    }

    public function update(Request $request, string $id)
    {
        
        $this->validate($request,[
            'editcountry_id'=>'required',
            'editcity_id'=>'required',
            'editname'=>'required|unique:regions,name,'.$id
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $region = Region::findOrFail($id);
        $region->name = $request['editname'];
        $region->slug = Str::slug($request['editname']);
        $region->country_id = $request['editcountry_id'];
        $region->city_id = $request['editcity_id'];
        $region->status_id = $request['editstatus_id'];
        $region->user_id = $user_id;

        $region->save();

        session()->flash('success','Update Successfully');
        return redirect(route('regions.index'));
    }

    public function destroy(string $id)
    {
        $region = Region::findOrFail($id);
        $region->delete();
        return redirect()->back();
    }

    public function typestatus(Request $request){
        $region = Region::findOrFail($request['id']);
        $region->status_id = $request['status_id'];
        $region->save();

        return response()->json(['success'=>"Status Change Successfully."]);
    }


    public function bulkdeletes(Request $request)
    {

        try{
            $getselectedids = $request->selectedids;
            Region::whereIn('id',$getselectedids)->delete();
            return response()->json(['status'=>'Selected data have been deleted successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>'failed','message'=>$e->getMessage()]);
        }

    }
}
