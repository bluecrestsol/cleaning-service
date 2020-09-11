<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;
use App\Models\Note;
use App\Models\Address;
use App\Models\Country;
use App\Models\Company;
use App\Models\AgentLanguage;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Support\Arr;

/**
 * Model for agents
 */
class Agent extends Model
{
    use HasDatatable, ExtendedEloquentTrait;
    
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'code',
        'email',
        'password',
        'type',
        'commission_rate',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'position',
        'gender',
        'nationality_country_id',
        'country_id',
        'company_id',
        'date_of_birth',
        'doc_type',
        'doc_number',
        'status',
        'mobile_number',
        'phone',
        'line',
        'whatsapp',
        'doc_file',
        'photo_file',
        'whatsapp',
        'created_at',
        'updated_at'
    ];
    
    /**
     * Attributes that should be converted to dates
     *
     * @var array
     */
    protected $dates = ['date_of_birth'];

    /**
     * Attributes that should be appended to the model
     *
     * @var array
     */
    protected $appends = [
        'age'
    ];

    /**
     * Define agent age attribute
     *
     * @return int|null
     */
    public function getAgeAttribute()
    {
        return (isset($this->attributes['date_of_birth'])) ? Carbon::parse($this->attributes['date_of_birth'])->age : null;
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
     * Define relationship to addresses
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Define relationship to nationality country
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nationality_country()
    {
        return $this->belongsTo(Country::class, 'nationality_country_id');
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
     * Define relationship to company
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Define relationship to languages
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany(Language::class, AgentLanguage::class, 'agent_id', 'language_id')
            ->withTimestamps();
    }

    /**
     * Define relationship to places
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function places()
    {
        return $this->hasMany(Place::class, 'agent_id');
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
        return $query->filterBy('status', $param['status'])
            ->filterBy('country_id', $param['country']);
    }

    /**
     * Agent's boot
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();
        
        static::deleting(function($agent) {
            optional($agent->languages())->detach();
        });
    }
}
