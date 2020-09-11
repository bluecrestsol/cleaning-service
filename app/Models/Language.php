<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ExtendedEloquentTrait;
use App\Traits\HasDatatable;
use App\Models\Country;
use App\Models\CountryLanguage;

class Language extends Model
{
    use HasDatatable, ExtendedEloquentTrait;
    
    protected  $fillable = [
        'code',
        'name',
        'english_name',
        'status_public',
        'status_staff',
        'created_at',
        'updated_at'
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class, CountryLanguage::class, 'language_id', 'country_id')
                ->withPivot(['status', 'is_primary'])
                ->withTimestamps();
    }

    public function scopeOfStaffEnabled($query)
    {
        return $query->where('status_staff', 'enabled');
    }

    public function scopeOfPublicActive($query)
    {
        return $query->whereIn('status_public', ['enabled', 'draft']);
    }
}