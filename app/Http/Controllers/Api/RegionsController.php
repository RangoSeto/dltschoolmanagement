<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RegionsResource;
use App\Models\City;
use App\Models\Region;
use Illuminate\Support\Str;

class RegionsController extends Controller
{


    public function typestatus(Request $request){
        $city = Region::findOrFail($request['id']);
        $city->status_id = $request['status_id'];
        $city->save();

        return new RegionsResource($city);
    }

    public function filterbycityid($filter){
        return RegionsResource::collection(Region::where('city_id',$filter)->where('status_id',3)->orderBy('name','asc')->get());
    }
}
