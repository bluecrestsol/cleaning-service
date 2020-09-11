<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\BaseController;

class ContactController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('customer.contact.index');
    }
}
