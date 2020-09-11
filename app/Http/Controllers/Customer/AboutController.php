<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\BaseController;

class AboutController extends BaseController
{
    /**
     * Initialization
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * About us page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('customer.about.index');
    }
}
