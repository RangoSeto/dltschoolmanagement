<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypesResource;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Status;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return TypesResource::collection($types);
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
            $types = Type::where('name',"LIKE","%{$query}%")->get();
        }else{
            $types = Type::all();
        }

        return TypesResource::collection($types);
    }
}
