<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Arr;

class City extends Model
{
    use HasDatatable, ExtendedEloquentTrait, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'country_id',
        'state_id',
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

    public function districts()
    {
        return $this->hasMany(District::class, 'city_id');
    }

    public function places()
    {
        return $this->hasMany(Place::class, 'city_id');
    }

    public function scopeOnlyActive($query)
    {
        return $query->whereIn('status', ['enabled']);
    }

    public function scopeFilter($query, $param)
    {
        return $query->filterBy('country_id', Arr::get($param, 'country'))
            ->filterBy('state_id', Arr::get($param, 'state'))
            ->singleOrder('$$name', 'asc');
    }
}
