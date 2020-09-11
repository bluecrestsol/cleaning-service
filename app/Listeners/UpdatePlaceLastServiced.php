<?php

namespace App\Listeners;

use App\Events\AppointmentMade;
use App\Services\AppointmentService;
use App\Services\PlaceService;
use Illuminate\Support\Carbon;

/**
 * Listener for updating place last serviced date
 */
class UpdatePlaceLastServiced
{
     /**
     * @var AppointmentService $appointmentService
     * @var PlaceService $placeService
     */
    protected $appointmentService;
    protected $placeService;

    /**
     * Create the event listener.
     *
     * @param AppointmentService $appointmentService
     * @param PlaceService $placeService
     */
    public function __construct(AppointmentService $appointmentService, PlaceService $placeService)
    {
        $this->placeService = $placeService;
        $this->appointmentService = $appointmentService;
    }

    /**
     * Handle the event.
     *
     * @param  AppointmentMade $event
     * @return void
     */
    public function handle(AppointmentMade $event)
    {
        $appointment = $event->appointment;
        $latest = $this->appointmentService->getLatestServicedAtByPlace($appointment->place_id);
        if ($appointment->serviced_at->eq(Carbon::parse($latest))) {
            $this->placeService->updateLastServicedById($appointment->place_id, $latest);
        }
    }
}
