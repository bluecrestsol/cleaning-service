<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BillingDetail;
use App\Models\Country;
use App\Models\Address;

/**
 * Model for companies
 */
class Company extends Model
{
    use HasDatatable, ExtendedEloquentTrait, SoftDeletes;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'country_id',
        'reg_number',
        'website',
        'facebook',
        'instagram',
        'youtube',
        'linkedin',
        'phone',
        'whatsapp',
        'line',
        'facebook_username',
        'customer_service_phone',
        'customer_service_email'
    ];

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
     * Define relationship to country
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    /**
     * Define relationship to countries
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function serviced_countries()
    {
        return $this->belongsToMany(Country::class);
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
     * Company's boot
     *
     * @return void
     */
    public static function boot() {
        parent::boot();
        self::deleting(function($company) { // before delete() method call this
            optional($company->address)->delete();
            optional($company->serviced_countries() ?? null)->detach();
            optional($company->billing_details)->delete();
        });
    }
}
