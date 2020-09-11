<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\LanguageCollection;

class CountryResource extends JsonResource
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
            'name' => $this->name,
            'status' => $this->status,
            'area_unit' => $this->area_unit,
            'has_states' => $this->has_states,
            'has_cities' => $this->has_cities,
            'has_districts' => $this->has_districts,
            'has_zip' => $this->has_zip,
            'languages' => new LanguageCollection($this->whenLoaded('public_active_languages'))
        ];
    }
}
