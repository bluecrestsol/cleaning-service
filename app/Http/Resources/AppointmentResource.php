<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\LocaleCollection;

class AppointmentResource extends JsonResource
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
            'customer_id' => $this->customer_id,
            'customer' => $this->customer,
            'admin_id' => $this->admin_id,
            'admin' => $this->admin,
            'agent_id' => $this->agent_id,
            'agent' => $this->agent,
            'place_id' => $this->place_id,
            'place' => $this->place,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status,
            'services' => new LocaleCollection($this->whenLoaded('services')),
            'serviced_at' => $this->serviced_at
        ];
    }
}
