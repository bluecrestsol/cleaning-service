<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDatatable;
use App\Traits\ExtendedEloquentTrait;

/**
 * Model for notes
 */
class Note extends Model
{
    use HasDatatable, ExtendedEloquentTrait;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'message'
    ];

    /**
     * Define note as polymorphic
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function noteable()
    {
        return $this->morphTo();
    }
}
