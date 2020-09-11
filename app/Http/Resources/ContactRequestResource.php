<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactRequestResource extends JsonResource
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
            'name' => $this->name,
            'business_name' => $this->business_name,
            'status' => $this->status,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
            'country_id' => $this->country_id,
            'company_id' => $this->company_id
        ];
    }
}
