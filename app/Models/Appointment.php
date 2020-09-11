<?php

namespace App\Models;

use App\Traits\ExtendedEloquentTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Models\Customer;
use App\Models\Place;
use App\Models\Contract;
use App\Models\Currency;
use App\Models\Note;
use App\Models\Service;
use App\Models\CrewMember;
use App\Models\AppointmentService;
use App\Models\AppointmentCrewMember;
use Carbon\Carbon;

/**
 * Model for Appointments
 */
class Appointment extends Model
{
    use HasDatatable, ExtendedEloquentTrait;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'code',
        'customer_id',
        'admin_id',
        'agent_id',
        'place_id',
        'contract_id',
        'service_id',
        'description',
        'currency_id',
        'price',
        'ordered_at',
        'status',
        'payment_term',
        'payment_method',
        'invoice_number',
        'invoice_file',
        'scheduled_at',
        'payment_due_at',
        'paid_at',
        'serviced_at',
        'created_at',
        'updated_at'
    ];

    /**
     * Attributes that should be converted to dates
     *
     * @var array
     */
    protected $dates = ['ordered_at', 'scheduled_at', 'payment_due_at', 'serviced_at'];

    /**
     * Define relationship to customer
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id')
            ->with('country');
    }

    /**
     * Define relationship to place
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    /**
     * Define relationship to contract
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    /**
     * Define relationship to currency
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

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
     * Define relationship to services
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, AppointmentService::class, 'appointment_id', 'service_id')
            ->withTimestamps();
    }

    /**
     * Define relationship to crew members
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function crew_members()
    {
        return $this->belongsToMany(CrewMember::class, AppointmentCrewMember::class, 'appointment_id', 'crew_member_id')
            ->withPivot(['is_leader'])
            ->withTimestamps()
            ->orderBy('is_leader', 'DESC')
            ->orderBy('first_name', 'ASC')
            ->orderBy('last_name', 'ASC');
    }

    /**
     * Scope for appointments that has public listing place
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasPublicListingPlace($query)
    {
        return $query->whereHas('place', function($query) {
            $query->where('is_listing_public', 1);
        });
    }

    /**
     * Scope for appointment services on a given company and country
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param int $company
     * @param int $country
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsServiceOnCompanyAndCountry($query, $company, $country)
    {
        return $query->whereHas('services', function($query) use ($company, $country) {
            $query->filterBy('company_id', $company)
                ->filterBy('country_id', $country);
        });
    }

    /**
     * Convert payment_due_at date to end of the day datetime
     *
     * @param string $value
     * @return void
     */
    public function setPaymentDueAtAttribute($value) {
        if (!empty($value)) {
            $value = Carbon::createFromFormat('m/d/Y', $value)
                ->endOfDay()
                ->toDateTimeString();
        }
        $this->attributes['payment_due_at'] = $value;
    }

    /**
     * Appointment's model boot
     *
     * @return void
     */
    public static function boot() {
        parent::boot();
        self::deleting(function($appointment) { // before delete() method call this
             optional($appointment->services() ?? null)->detach();
             optional($appointment->crew_members() ?? null)->detach();
        });
    }
}
