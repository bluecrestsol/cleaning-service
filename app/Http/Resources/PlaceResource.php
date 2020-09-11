<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PlacesCategoryResource;

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
            'customer' => new PlacesCategoryResource($this->whenLoaded('customer')),
            'category' => new PlacesCategoryResource($this->whenLoaded('category')),
            'status' => $this->status,
            'name' => $this->name,
            'description' => $this->description,
            'area' => $this->area,
            'district' => new LocaleResource($this->whenLoaded('district')),
            'city' => new LocaleResource($this->whenLoaded('city')),
            'state' => new LocaleResource($this->whenLoaded('state')),
            'country' => new LocaleResource($this->whenLoaded('country')),
            'type' => $this->type,
            'is_listing_public' => $this->is_listing_public,
            'is_history_public' => $this->is_history_public,
            'is_gallery_public' => $this->is_gallery_public,
            'last_serviced_at' => $this->last_serviced_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
