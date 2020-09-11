<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\BaseController;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class PricingController extends BaseController
{
    /**
     * @var ServiceService
     */
    private $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        parent::__construct();
        $this->serviceService = $serviceService;
    }

    public function index(Request $request)
    {
        $request->merge([
            'order' => [
                ['column' => 'order', 'dir' => 'asc']
            ],
            'status' => 'enabled'
        ]);

        $services = $this->serviceService->getAll($request->query());

        return view('customer.pricing.index', compact('services'));
    }
}
