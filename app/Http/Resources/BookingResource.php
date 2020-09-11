<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ServiceCollection;

class BookingResource extends JsonResource
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
            'status' => $this->status,
            'booked_at' => $this->booked_at,
            'name' => $this->name,
            'business_name' => $this->business_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'area' => $this->area,
            'service_id' => $this->service_id,
            'address' => $this->address,
            'notes' => $this->notes,
            'service' => $this->service,
            'company_id' => $this->company_id,
            'company' => $this->company,
            'country_id' => $this->country_id,
            'country' => $this->country,
            'category_id' => $this->category_id,
            'category' => $this->category,
            'created_at' => $this->created_at,
        ];
    }
}
