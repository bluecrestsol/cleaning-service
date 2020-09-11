<?php

namespace App\Events;

use App\Models\Appointment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Event for every appointment made
 */
class AppointmentMade
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     /**
     * @var Appointment $appointment
     */
    public $appointment;

    /**
     * Create a new event instance.
     *
     * @param Appointment $appointment
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }
}
