<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\PlaceResource;
use App\Services\PlaceService;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * @var PlaceService
     */
    private $serviceService;

    /**
     * Initialization
     * 
     * @param App\Services\PlaceService $placeService
     */
    public function __construct(PlaceService $placeService)
    {
        $this->placeService = $placeService;
    }

    /**
     * Get place by ID
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\PlaceResource
     */
    public function get(Request $request, $id)
    {
        return (new PlaceResource($this->placeService->getById($id)));
    }

    /**
     * Get place by code
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\PlaceResource
     */
    public function getByCode(Request $request, $code)
    {
        return (new PlaceResource($this->placeService->getByCode($code)));
    }
}
