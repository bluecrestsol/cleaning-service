<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'name' => $this->getTranslations('name'),
            'type' => $this->type,
            'description' => $this->getTranslations('description'),
            'public_name' => $this->getTranslations('public_name'),
            'status' => $this->status,
            'price' => $this->price,
            'discounted_price' => $this->discounted_price,
            'order' => $this->order,
        ];
    }
}
