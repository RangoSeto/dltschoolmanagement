<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Country;
use App\Models\City;
use App\Models\User;
use App\Models\Status;


class RegionsResource extends JsonResource
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
            'country_id'=>$this->country_id,
            'city_id'=>$this->city_id,
            'status_id'=>$this->status_id,
            'user_id'=>$this->user_id,
            'created_at'=>$this->created_at->format("d m Y"),
            'updated_at'=>$this->updated_at->format("d m Y"),
            'country'=>Country::where('id',$this->country_id)->select(['id','name'])->first(),
            'city'=>City::where('id',$this->city_id)->select(['id','name'])->first(),
            'user'=>User::where('id',$this->user_id)->select(['id','name'])->first(),
            'status'=>Status::where('id',$this->status_id)->select(['id','name'])->first()
        ];
    }
}
