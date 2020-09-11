<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;
use Spatie\Translatable\HasTranslations;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Place;
use Illuminate\Support\Arr;

class District extends Model
{
    use HasDatatable, ExtendedEloquentTrait, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'country_id',
        'state_id',
        'city_id',
        'name'
    ];

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function public_listing_places()
    {
        return $this->hasMany(Place::class, 'district_id')
            ->publicListing();
    }

    /**
     * Scope a query for filtering
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param array $param
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $param)
    {
        return $query->filterBy('country_id', Arr::get($param, 'country'))
            ->filterBy('state_id', Arr::get($param, 'state'))
            ->filterBy('city_id', Arr::get($param, 'city'));
    }

     /**
     * Define a relationship to places that are public listing and has been serviced
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serviced_public_listing_places()
    {
        return $this->hasMany(Place::class, 'district_id')
            ->publicListing()
            ->serviced();
    }

    public function scopeOnlyActive($query)
    {
        return $query->whereIn('status', ['enabled']);
    }
}
