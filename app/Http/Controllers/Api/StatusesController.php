<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\StatusesResource;
use App\Models\Status;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all();
        return StatusesResource::collection($statuses);
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


    public function search(Request $request)
    {

        $query = $request->input('query');

        if($query){
            $statuses = Status::where("name","LIKE","%{$query}%")->get();
        }else{
            $statuses = Status::all();
        }

        return StatusesResource::collection($statuses);
    }
}


// php artisan make:controller Api/StatusesController --api
// php artisan make:resource StatusesResource
