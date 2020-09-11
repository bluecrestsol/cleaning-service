<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\BaseController;
use App\Services\AppointmentService;

class HomeController extends BaseController
{
    /**
     * @var AppointmentService
     */
    private $appointmentService;

    /**
     * HomeController constructor.
     * @param AppointmentService $appointmentService
     */
    public function __construct(AppointmentService $appointmentService)
    {
        parent::__construct();
        $this->appointmentService = $appointmentService;
    }

    public function index()
    {
        $main = app('shared')->get('main');
        request()->merge(['status' => 'completed']);
        $appointments = $this->appointmentService->getWithPublicServices(
            $main['company']->id,
            $main['country']->id,
            [[ 'column' => 'serviced_at', 'dir' => 'DESC']]
        )->take(10)->all();

        return view('customer.home.index', compact('appointments'));
    }

    public function pricing()
    {
        return view('customer.home.index');
    }

    public function servicedLocations()
    {
        return view('customer.home.index');
    }

    public function testimonials()
    {
        return view('customer.home.index');
    }

    public function faq()
    {
        return view('customer.home.index');
    }

    public function verify()
    {
        return view('customer.verify.index');
    }

    public function contact()
    {
        return view('customer.contact.index');
    }

    public function privacyPolicy()
    {
        echo 'privacy';
    }

    public function terms()
    {
        return 'terms';
    }

    public function workWithUs()
    {
        return 'work with us';
    }
}
