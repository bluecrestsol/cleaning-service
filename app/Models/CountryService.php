<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Traits\ExtendedEloquentTrait;

class CountryService extends Pivot
{
    use ExtendedEloquentTrait;
    
    protected $table = "country_service";
}