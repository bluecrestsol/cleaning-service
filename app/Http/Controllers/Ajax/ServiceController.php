<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocaleCollection;
use App\Services\ServiceService;
use Illuminate\Http\Request;

/**
 * Ajax controller for services
 */
class ServiceController extends Controller
{
    /**
     * @var ServiceService $serviceService
     */
    private $serviceService;

    /**
     * Initialization
     *
     * @param ServiceService $serviceService
     */
    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * List of services for table
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $records = $this->serviceService->list($request, ['type', '$$name', 'price', 'discounted_price', 'status'],
            ['id', 'order', 'type', '$$name', 'price', 'discounted_price', 'status']);
        $records['data'] = new LocaleCollection($records['data']);
        return response()->json($records);
    }

    /**
     * Fetch list of services
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch(Request $request)
    {
        $request->merge([
            'order' => [
                [
                    'column' => 'order',
                    'dir' => 'asc'
                ]
            ],
            'status' => 'enabled'
        ]);

        return (new LocaleCollection($this->serviceService->getAll($request->query())))
            ->additional(['success' => true]);
    }

    /**
     * Update order sequence of some services
     *
     * @param Request $request
     * @param int $country
     * @return \Illuminate\Http\JsonResponse
     */
    public function order(Request $request, $country)
    {
        $records = $this->serviceService->updateSequence($country, $request->list);
        return response()->json($records);
    }
}
