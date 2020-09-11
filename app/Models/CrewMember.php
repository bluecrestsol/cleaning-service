<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;
use App\Models\Note;
use App\Models\Address;
use App\Models\Country;
use App\Models\Company;
use App\Models\Appointment;
use App\Models\CrewMemberLanguage;
use App\Models\Language;
use Carbon\Carbon;

class CrewMember extends Model
{
    use HasDatatable, ExtendedEloquentTrait;
    
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'crew_members';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

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

    protected $dates = ['date_of_birth'];

    protected $appends = [
        'age'
    ];

    public function getAgeAttribute()
    {
        return (isset($this->attributes['date_of_birth'])) ? Carbon::parse($this->attributes['date_of_birth'])->age : null;
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function nationality_country()
    {
        return $this->belongsTo(Country::class, 'nationality_country_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, CrewMemberLanguage::class, 'crew_member_id', 'language_id')
                ->withTimestamps();
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, AppointmentCrewMember::class, 'crew_member_id', 'appointment_id')
                ->withPivot(['is_leader'])
                ->withTimestamps();
    }

    public function scopeJoinAppointment($query, $callback = null) {
        return $query->select([
            'crew_members.*',
            DB::raw('appointment_crew_member.appointment_id AS appointment_id'),
        ])
        ->leftJoin('appointment_crew_member', function($join) use ($callback) {
            $join->on('appointment_crew_member.crew_member_id', 'crew_members.id')
                ->when($callback, function($query, $callback) {
                    return $callback($query);
                });
        });
    }

    public function scopeJoinAppointmentLeaders($query) {
        return $query->joinAppointment(function($join) {
            return $join->where('appointment_crew_member.is_leader', 1);
        });
    }

    protected static function boot() {
        parent::boot();
        
        static::deleting(function($crewMember) {
            optional($crewMember->languages())->detach();
        });
    }
}
