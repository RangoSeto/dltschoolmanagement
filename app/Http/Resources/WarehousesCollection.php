<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\User;
use App\Models\Status;

class WarehousesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data'=>$this->collection->transform(function($warehouse){
                return [
                    'id'=>$warehouse->id,
                    'name'=>$warehouse->name,
                    'slug'=>$warehouse->slug,
                    'status_id'=>$warehouse->status_id,
                    'user_id'=>$warehouse->user_id,
                    'created_at'=>$warehouse->created_at->format("d m Y"),
                    'updated_at'=>$warehouse->updated_at->format("d m Y"),
                    // 'user'=>User::where('id',$warehouse->user_id)->first()
                    // 'user'=>User::where('id',$warehouse->user_id)->first('name')
                    // 'user'=>User::where('id',$warehouse->user_id)->pluck('name')
                    // 'user'=>User::where('id',$warehouse->user_id)->select('id','name')->get()
                    // 'user'=>User::where('id',$warehouse->user_id)->select(['id','name'])->get()
                    'user'=>User::where('id',$warehouse->user_id)->select(['id','name'])->first(),
                    'status'=>Status::where('id',$warehouse->status_id)->select(['id','name'])->first()
                ];
            })
        ];
    }
}
