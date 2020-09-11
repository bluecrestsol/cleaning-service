<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\BaseController;
use App\Services\CityService;
use App\Services\PlaceService;
use App\Services\DistrictService;
use Illuminate\Http\Request;

/**
 * Controller for completed services
 */
class ServicedLocationController extends BaseController
{
    /**
     * @var CityService $cityService
     * @var PlaceService $placeService
     * @var DistrictService $districtService
     */
    private $cityService, $placeService, $districtService;

    /**
     * Initialization
     *
     * @param CityService $cityService
     * @param PlaceService $placeService
     * @param DistrictService $districtService
     */
    public function __construct(CityService $cityService, PlaceService $placeService,
        DistrictService $districtService)
    {
        parent::__construct();
        $this->cityService = $cityService;
        $this->placeService = $placeService;
        $this->districtService = $districtService;
    }

    /**
     * Serviced locations main page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $main = app('shared')->get('main');
        $cities = $this->cityService->getAll(['country' => $main['country']->id]);
        return view('customer.serviced-locations.index', compact('cities'));
    }

    /**
     * Serviced locations per district page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id, $city, $district)
    {
        $main = app('shared')->get('main');

        $district = $this->districtService->getById($id);
        $places = $this->placeService->getAllServiced([
            'district' => $id,
            'country' => $main['country']->id
        ]);
        return view('customer.serviced-locations.show', compact('district', 'places'));
    }
}
