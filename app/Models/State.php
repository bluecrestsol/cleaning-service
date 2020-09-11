<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;
use Spatie\Translatable\HasTranslations;

class State extends Model
{
    use HasDatatable, ExtendedEloquentTrait, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'country_id',
        'name'
    ];

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
}