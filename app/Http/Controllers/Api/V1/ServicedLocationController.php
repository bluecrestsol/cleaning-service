<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CityCollection;
use App\Http\Resources\Api\V1\PlaceCollection;
use App\Services\CityService;
use App\Services\PlaceService;
use Illuminate\Http\Request;

class ServicedLocationController extends Controller
{
    /**
     * @var CityService
     * @var PlaceService
     */
    private $cityService,$placeService ;

    /**
     * Initialization
     * 
     * @param App\Services\CityService $cityService
     */
    public function __construct(CityService $cityService, PlaceService $placeService)
    {
        $this->cityService = $cityService;
        $this->placeService = $placeService;
    }

    /**
     * Show list of serviced locations per country
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\CityCollection
     */
    public function index(Request $request, $country)
    {
        $cities = $this->cityService->getServicedWithDistricts(['country' => $country]);
        return (new CityCollection($cities));
    }

    /**
     * Show serviced locations per district
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\PlaceCollection
     */
    public function show(Request $request, $country, $district)
    {
        return (new PlaceCollection($this->placeService->getAllServiced(
            [ 'country' => $country, 'district' => $district ]
        )));
    }
}
