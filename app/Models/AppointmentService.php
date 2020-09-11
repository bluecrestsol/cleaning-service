<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentService extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'appointment_service';

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
        'appointment_id',
        'service_id',
        'created_at',
        'updated_at'
    ];
}
