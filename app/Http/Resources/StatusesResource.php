<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class StatusesResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'created_at'=>$this->created_at->format("d m Y"),
            'updated_at'=>$this->updated_at->format("d m Y"),
            'user'=>User::where('id',$this->user_id)->select(['id','name'])->first()
        ];
    }
}
