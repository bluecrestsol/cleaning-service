<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentCrewMember extends Model
{
    protected $table = 'appointment_crew_member';
    
    protected $fillable = [
        'crew_member_id',
        'appointment_id',
        'created_at',
        'updated_at'
    ];
}
