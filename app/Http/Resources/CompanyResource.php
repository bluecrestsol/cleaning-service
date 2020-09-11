<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'country_id' => $this->country_id,
            'reg_number' => $this->reg_number,
            'website' => $this->website,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'linkedin' => $this->linkedin,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'line' => $this->line,
            'facebook_username' => $this->facebook_username,
            'customer_service_phone' => $this->customer_service_phone,
            'customer_service_email' => $this->customer_service_email
        ];
    }
}
