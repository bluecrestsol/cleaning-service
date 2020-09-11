<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;
use Spatie\Translatable\HasTranslations;

class PlacesCategory extends Model
{
    use HasDatatable, ExtendedEloquentTrait, HasTranslations;

    protected $fillable = [
        'name',
        'type',
        'created_at',
        'updated_at'
    ];

    public $translatable = ['name'];
}
