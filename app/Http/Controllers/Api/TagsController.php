<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagsResource;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Status;


class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy('id','asc')->paginate(10);
        $statuses = Status::whereIn('id',[3,4])->get();
        return TagsResource::collection($tags);
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
            $tags = Tag::where('name',"LIKE","%{$query}%")->orderBy('id','asc')->get();
        }else{
            $tags = Tag::orderBy('id','asc')->paginate(10)->withQueryString();
        }

        return TagsResource::collection($tags);

    }
}
