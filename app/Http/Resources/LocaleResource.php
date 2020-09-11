<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $attributes = parent::toArray($request);
        if (!empty($attributes)) {
            $translatable = (isset($this->translatable) && is_array($this->translatable))
                ? $this->translatable : [];
            foreach ($translatable as $name) {
                $attributes[$name] = $this->{$name};
            }
        }
        return $attributes;
    }
}
