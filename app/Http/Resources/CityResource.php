<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ServiceCollection;

class CityResource extends JsonResource
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
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'name' => $this->name,
            'districts' => new LocaleCollection($this->whenLoaded('districts')),
            'serviced_public_listing_places_count' => $this->whenLoaded('serviced_public_listing_places_count')
        ];
    }
}
