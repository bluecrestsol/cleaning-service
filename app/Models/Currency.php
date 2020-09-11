<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Models\Country;
use App\Models\CountryCurrency;

class Currency extends Model
{
    use HasDatatable;

    protected $fillable = [
        'code',
        'symbol',
        'name'
    ];
}
