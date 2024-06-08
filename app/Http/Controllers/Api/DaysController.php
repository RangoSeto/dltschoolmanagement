<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DaysResource;
use App\Http\Resources\StatusesResource;
use Illuminate\Http\Request;

use App\Models\Day;
use App\Models\Status;

class DaysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $days = Day::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return StatusesResource::collection($days);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function search(Request $request){
        $query = $request->input('query');

        if($query){
            $days = Day::where('name','LIKE',"%{$query}%")->get();
        }else{
            $days = Day::all();
        }
        return DaysResource::collection($days);
    }
}
