<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use App\Http\Resources\AppointmentCollection;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    private $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }
    
    public function list(Request $request)
    {   
        $records = $this->appointmentService->list($request);
        return response()->json($records);
    }

    /**
     * List of place's service history
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listServiceHistory(Request $request)
    {
        $records = $this->appointmentService->listServiceHistory($request);
        $records['data'] = (new AppointmentCollection($records['data']));
        return response()->json($records);
    }
}
