<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceCollection;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * @var ServiceService
     */
    private $serviceService;

    /**
     * Initialization
     * 
     * @param App\Services\ServiceService $serviceService
     */
    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * Get list of pricings
     *
     * @param Request $request
     * @return App\Http\Resources\ServiceCollection
     */
    public function index(Request $request, $company)
    {
        $request->merge([
            'company' => $company
        ]);
        return (new ServiceCollection($this->serviceService->getAll($request->query())));
    }
}
