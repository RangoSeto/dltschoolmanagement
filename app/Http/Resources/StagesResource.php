<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\Status;

class StagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'slug'=>$this->slug,
            'status_id'=>$this->status_id,
            'user_id'=>$this->user_id,
            'user'=>User::where('id',$this->user_id)->select(['id','name'])->first(),
            'status'=>Status::where('id',$this->status_id)->select(['id','name'])->first()
        ];
    }
}
