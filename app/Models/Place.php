<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ExtendedEloquentTrait;
use App\Models\Note;
use App\Models\Address;
use App\Models\BillingDetail;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\PlacesCategory;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\District;
use App\Models\Appointment;
use App\Models\Contract;
use App\Traits\HasDatatable;
use Illuminate\Support\Arr;

/**
 * Model for places
 */
class Place extends Model
{
    use HasDatatable, ExtendedEloquentTrait;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'financial_type',
        'agent_id',
        'customer_id',
        'places_category_id',
        'status',
        'name',
        'description',
        'area_unit',
        'area',
        'district_id',
        'city_id',
        'state_id',
        'country_id',
        'type',
        'is_listing_public',
        'is_history_public',
        'is_gallery_public',
        'last_serviced_at',
        'created_at',
        'updated_at'
    ];

    /**
     * Attributes that should be converted to dates
     *
     * @var array
     */
    protected $dates = ['last_serviced_at'];

    /**
     * Define relationship to notes
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    /**
     * Define relationship to address
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * Define relationship to billing details
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function billing_details()
    {
        return $this->morphOne(BillingDetail::class, 'billing_detailable');
    }

    /**
     * Define relationship to agent
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    /**
     * Define relationship to customer
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Define relationship to category
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(PlacesCategory::class, 'places_category_id');
    }

    /**
     * Define relationship to country
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * Define relationship to state
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     * Define relationship to city
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Define relationship to district
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * Scope a query to only include public listing places
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scopePublicListing($query)
    {
        return $query->where('is_listing_public', 1);
    }

    /**
     * Scope a query to only include places that has been serviced
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scopeServiced($query)
    {
        return $query->whereNotNull('last_serviced_at');
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
        return $query->filterBy('customer_id', Arr::get($param, 'customer'))
            ->filterBy('district_id', Arr::get($param, 'district'))
            ->filterBy('country_id', Arr::get($param, 'country'))
            ->filterBy('status', Arr::get($param, 'status'))
            ->filterBy('code', Arr::get($param, 'code'));
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
     * Define relationship to contracts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    /**
     * Place's boot
     *
     * @return void
     */
    public static function boot() {
        parent::boot();
        self::deleting(function($place) { // before delete() method call this
             optional($place->address)->delete();
             optional($place->billing_details)->delete();
        });
    }
}
