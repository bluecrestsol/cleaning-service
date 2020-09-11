<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\PlacesCategoryService;
use Illuminate\Http\Request;
use App\Http\Resources\LocaleCollection;

/**
 * Ajax controller for places category
 */
class PlacesCategoryController extends Controller
{
    /**
     * @var PlacesCategoryService $placesCategoryService
     */
    protected $placesCategoryService;

    /**
     * Initialization
     *
     * @param PlacesCategoryService $placesCategoryService
     */
    public function __construct(PlacesCategoryService $placesCategoryService)
    {
        $this->placesCategoryService = $placesCategoryService;
    }

    /**
     * List of places category for table
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $records = $this->placesCategoryService->list($request);
        $records['data'] = new LocaleCollection($records['data']);
        return response()->json($records);
    }

    /**
     * Fetch list of places category
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch(Request $request)
    {
        return (new LocaleCollection($this->placesCategoryService->getAll($request->query())))
            ->additional(['success' => true]);
    }
}
