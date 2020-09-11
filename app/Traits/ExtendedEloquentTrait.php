<?php

namespace App\Traits;

Trait ExtendedEloquentTrait {

    public function scopeFilterBy($query, $key, $value)
    {
        return $query->when($value, function ($query, $value) use ($key) {
                return $query->whereIn($key, explode(',', $value));
            });
    }
}

?>