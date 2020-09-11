<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;
use App\Models\Note;
use App\Models\Address;
use App\Models\Company;
use App\Models\Country;
use App\Models\Language;
use App\Models\BillingDetail;
use App\Models\Booking;

class Customer extends Model
{
    use HasDatatable, ExtendedEloquentTrait;

    protected $fillable = [
        'code',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'company_id',
        'country_id',
        'language_id',
        'business_name',
        'email',
        'mobile',
        'phone',
        'line',
        'whatsapp',
        'created_at',
        'updated_at'
    ];

    protected $with = ['country'];

    public function places()
    {
        return $this->hasMany(Place::class, 'customer_id');
    }
                            
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function billing_details()
    {
        return $this->morphOne(BillingDetail::class, 'billing_detailable');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();
        self::deleting(function($customer) { // before delete() method call this
             optional($customer->billing_details)->delete();
        });
    }
}
