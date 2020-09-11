<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\BaseController;
use App\Services\ContactRequestService;

class FaqController extends BaseController
{
    /**
     * @var ContactRequestService
     */
    private $contactRequestService;

    public function __construct(ContactRequestService $contactRequestService)
    {
        parent::__construct();
        $this->contactRequestService = $contactRequestService;
    }

    public function index()
    {
        return view('customer.faq.index');
    }
}
