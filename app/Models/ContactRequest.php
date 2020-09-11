<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;

class ContactRequest extends Model
{
    use HasDatatable, ExtendedEloquentTrait;
    protected $table = 'contact_requests';

    protected $fillable = [
        'name',
        'business_name',
        'status',
        'email',
        'phone',
        'message',
        'country_id',
        'company_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
