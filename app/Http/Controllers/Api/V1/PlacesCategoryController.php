<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\PlacesCategoryCollection;
use App\Services\PlacesCategoryService;
use Illuminate\Http\Request;

class PlacesCategoryController extends Controller
{
    /**
     * @var PlacesCategoryService
     */
    private $serviceService;

    /**
     * Initialization
     * 
     * @param App\Services\PlacesCategoryService $placesCategoryService
     */
    public function __construct(PlacesCategoryService $placesCategoryService)
    {
        $this->placesCategoryService = $placesCategoryService;
    }

    /**
     * Get list of places categories
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\PlacesCategoryCollection
     */
    public function index(Request $request)
    {
        return (new PlacesCategoryCollection($this->placesCategoryService->getAll($request->query())));
    }
}
