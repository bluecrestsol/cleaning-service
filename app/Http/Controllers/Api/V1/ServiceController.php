<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ServiceCollection;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
     * @return App\Http\Resources\Api\V1\ServiceCollection
     */
    public function index(Request $request)
    {
        return (new ServiceCollection($this->serviceService->getAll($request->query())));
    }
}
