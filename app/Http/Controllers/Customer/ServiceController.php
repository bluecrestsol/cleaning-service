<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\BaseController;

class ServiceController extends BaseController
{
    /**
     * Initialization
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Services page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('customer.services.index');
    }
}
