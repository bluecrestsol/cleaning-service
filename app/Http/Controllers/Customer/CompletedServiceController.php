<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\BaseController;
use App\Services\AppointmentService;

/**
 * Controller for completed services
 */
class CompletedServiceController extends BaseController
{
    /**
     * @var AppointmentService $appointmentService
     */
    private $appointmentService;

    /**
     * Initialization
     *
     * @param AppointmentService $appointmentService
     */
    public function __construct(AppointmentService $appointmentService)
    {
        parent::__construct();
        $this->appointmentService = $appointmentService;
    }

    /**
     * Completed services page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $main = app('shared')->get('main');
        request()->merge(['status' => 'completed']);

        $appointments = $this->appointmentService->getWithPublicServices(
            $main['company']->id,
            $main['country']->id,
            [[ 'column' => 'serviced_at', 'dir' => 'DESC']]
        );
        return view('customer.completed-services.index', compact('appointments'));
    }
}
