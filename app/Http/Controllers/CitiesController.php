<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::where(function($query){
            if($getname = request('filtername')){
                $query->where('name',"LIKE",'%'.$getname.'%');
            }
        })->paginate(10);
        // $cities = City::all();
        return view('cities.index',compact('cities'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required|unique:cities,name'
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $city = new City();
        $city->name = $request['name'];
        $city->slug = Str::slug($request['name']);
        $city->user_id = $user_id;

        $city->save();
        return redirect(route('cities.index'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|unique:cities,name,'.$id
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $city = City::findOrFail($id);
        $city->name = $request['name'];
        $city->slug = Str::slug($request['name']);
        $city->user_id = $user_id;

        $city->save();
        return redirect(route('cities.index'));
    }

    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return redirect()->back();
    }
}
