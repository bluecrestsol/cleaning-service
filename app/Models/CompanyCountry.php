<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyCountry extends Pivot
{
    protected $table = "company_country";
}