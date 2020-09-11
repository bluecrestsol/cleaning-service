<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ServiceHistoryCollection;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class ServiceHistoryController extends Controller
{
    /**
     * @var AppointmentService
     */
    private $appointmentService;

    /**
     * Initialization
     * 
     * @param App\Services\AppointmentService $appointmentService
     */
    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    /**
     * Get list of pricings
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\ServiceHistoryCollection
     */
    public function index(Request $request, $place)
    {
        return (new ServiceHistoryCollection($this->appointmentService->getServiceHistory($place)));
    }
}
