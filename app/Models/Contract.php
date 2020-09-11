<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;
use App\Models\Appointment;
use Illuminate\Support\Arr;

class Contract extends Model
{
    use HasDatatable, ExtendedEloquentTrait;

    protected $fillable = [
        'code',
        'customer_id',
        'place_id',
        'frequency',
        'price_unit',
        'price',
        'started_at',
        'ended_at',
    ];

    protected $dates = ['started_at', 'ended_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    /**
     * Define relationship to appointments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Scope a query for filtering
     *
     * @param $query
     * @param $param
     * @return mixed
     */
    public function scopeFilter($query, $param)
    {
        return $query->filterBy('place_id', Arr::get($param, 'place'));
    }
}
