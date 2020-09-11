<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CountryLanguage extends Pivot
{
    protected $table = "country_language";
}