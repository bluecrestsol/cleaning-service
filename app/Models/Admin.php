<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\HasDatatable;
use App\Models\Note;
use App\Models\Address;
use App\Models\Company;
use App\Models\Country;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles, HasDatatable;

    protected $guard = 'staff';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'status',
        'active_company_id',
        'active_country_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeJoinWithRoles($query)
    {
        return $query->leftJoin('model_has_roles', 'admins.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_type', '=', static::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function active_company()
    {
        return $this->hasOne(Company::class, 'id', 'active_company_id');
    }

    public function active_country()
    {
        return $this->hasOne(Country::class, 'id', 'active_country_id')
            ->with('currency');
    }
}
