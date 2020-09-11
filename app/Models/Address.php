<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class Address extends Model
{
    protected $fillable = [
        'line_1',
        'line_2',
        'city',
        'state',
        'zip',
        'country_id'
    ];
    
    public function addressable()
    {
        return $this->morphTo();
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
