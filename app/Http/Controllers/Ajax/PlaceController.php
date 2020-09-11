<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\PlaceService;
use Illuminate\Http\Request;
use App\Http\Resources\PlaceCollection;

class PlaceController extends Controller
{
    private $placeService;

    public function __construct(PlaceService $placeService)
    {
        $this->placeService = $placeService;
    }

    public function list(Request $request)
    {
        $records = $this->placeService->list($request);
        return response()->json($records);
    }

    public function fetch(Request $request)
    {
        $query = $request->query();
        return (new PlaceCollection($this->placeService->getAll($query)))
            ->additional(['success' => true]);
    }

    /**
     * Fetch serviced locations
     *
     * @param Request $request
     * @return PlaceCollection
     */
    public function fetchServiced(Request $request)
    {
        $query = $request->query();
        return (new PlaceCollection($this->placeService->getAllServiced($query)))
            ->additional(['success' => true]);
    }

    /**
     * Search place by code
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByCode(Request $request)
    {
        $place = $this->placeService->getByCode($request->input('code'));

        if($place) {
            return response()->json([
                'success' => true,
                'data' => $place
            ], 200);
        }

        return response()->json([
            'success' => false,
        ], 404);
    }
}
