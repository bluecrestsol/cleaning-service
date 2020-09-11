<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;
use App\Models\Customer;
use App\Models\PlacesCategory;

/**
 * Model for bookings
 */
class Booking extends Model
{
    use HasDatatable, ExtendedEloquentTrait;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'booked_at',
        'name',
        'business_name',
        'email',
        'phone',
        'area',
        'address',
        'notes',
        'company_id',
        'service_id',
        'country_id',
        'category_id',
        'created_at'
    ];

    /**
     * Attributes that should be converted to dates
     *
     * @var array
     */
    protected $dates = ['booked_at'];

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
        return $this->belongsTo(PlacesCategory::class, 'category_id');
    }

    /**
     * Define relationship to service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
