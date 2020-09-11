<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;
use Spatie\Translatable\HasTranslations;

/**
 * Model for Services
 */
class Service extends Model
{
    use HasDatatable, ExtendedEloquentTrait, HasTranslations;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order',
        'name',
        'description',
        'public_name',
        'type',
        'price',
        'discounted_price',
        'status',
        'company_id',
        'country_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Attributes that are translatable
     *
     * @var array
     */
    public $translatable = ['name', 'public_name', 'description'];
}
