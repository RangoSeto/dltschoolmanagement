<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CitiesResource;
use App\Models\City;
use Illuminate\Support\Str;


class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $city = City::paginate(10);
        return CitiesResource::collection($city);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     "name"=>"required|unique:cities,name",
        //     "status_id"=>"required",
        //     "user_id"=>"required"
        // ]);

        $city = new City();
        $city->name = $request['name'];
        $city->slug = Str::slug($request['name']);
        $city->country_id = $request['country_id'];
        $city->status_id = $request['status_id'];
        $city->user_id = $request['user_id'];
        $city->save();

        return new CitiesResource($city);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            "editname"=>"required|unique:cities,name,".$id,
            "editcountry_id"=>"required",
            "editstatus_id"=>"required",
            "user_id"=>"required"
        ]);

        $city = City::findOrFail($id);
        $city->name = $request['editname'];
        $city->slug = Str::slug($request['editname']);
        $city->country_id = $request['editcountry_id'];
        $city->status_id = $request['editstatus_id'];
        $city->user_id = $request['user_id'];
        $city->save();

        return new CitiesResource($city);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return new CitiesResource($city);
    }


    public function typestatus(Request $request){
        $city = City::findOrFail($request['id']);
        $city->status_id = $request['status_id'];
        $city->save();

        return new CitiesResource($city);
    }
}
