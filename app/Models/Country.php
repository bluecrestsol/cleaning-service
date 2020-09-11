<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;
use App\Models\Language;
use App\Models\Currency;
use App\Models\Service;
use App\Models\Company;
use App\Models\CountryLanguage;
use App\Models\CountryCurrency;
use App\Models\CountryService;
use App\Models\CompanyCountry;

class Country extends Model
{
    use HasDatatable, ExtendedEloquentTrait;

    protected $fillable = [
        'code',
        'name',
        'status',
        'area_unit',
        'has_states',
        'has_cities',
        'has_districts',
        'has_zip',
        'currency_id'
    ];

    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        return __('countries.'.strtoupper($this->code));
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, CountryLanguage::class, 'country_id', 'language_id')
                ->withPivot(['status', 'is_primary'])
                ->withTimestamps();
    }

    public function public_active_languages()
    {
        return $this->languages()
            ->ofPublicActive()
            ->whereIn('country_language.status', ['enabled', 'draft']);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, CountryService::class, 'country_id', 'service_id')
                ->withPivot(['status'])
                ->withTimestamps();
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, CompanyCountry::class, 'country_id', 'company_id')
                ->withTimestamps();
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function scopeOnlyActive($query)
    {
        return $query->whereIn('status', ['enabled', 'draft']);
    }

    public function scopeWhereHasStates($query)
    {
        return $query->where('has_states', 1);
    }

    public function scopeWhereHasCities($query)
    {
        return $query->where('has_cities', 1);
    }

    public function scopeWhereHasDistricts($query)
    {
        return $query->where('has_districts', 1);
    }

}
