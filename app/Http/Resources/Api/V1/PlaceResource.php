<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\CityResource;
use App\Http\Resources\Api\V1\DistrictResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'status' => $this->status,
            'name' => $this->name,
            'description' => $this->description,
            'area' => $this->area,
            'type' => $this->type,
            'last_serviced_at' => $this->last_serviced_at,
            'city' => new CityResource($this->whenLoaded('city')),
            'district' => new DistrictResource($this->whenLoaded('district'))
        ];
    }
}
