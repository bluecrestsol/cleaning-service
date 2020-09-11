<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CountryCollection;
use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\Api\V1\CountryResource;
use App\Services\CountryService;
use Illuminate\Http\Request;

/**
 * Api controller for countries
 */
class CountryController extends Controller
{
    /**
     * @var App\Services\CountryService $countryService
     */
    protected $countryService;
    
    /**
     * Initialization
     * 
     * @param App\Services\CountryService $countryService
     */
    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    /**
     * Get list of countries
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\CountryCollection
     */
    public function index(Request $request)
    {
        return (new CountryCollection($this->countryService->getAll($request->query())));
    }

    /**
     * Get country by ID
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\CountryResource
     */
    public function get(Request $request, $id)
    {
        return (new BaseJsonResource(
            CountryResource::class,
            $this->countryService->getById($id))
        )->run();
    }

    /**
     * Get country by code
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\CountryResource
     */
    public function getByCode(Request $request, $code)
    {
        return (new BaseJsonResource(
            CountryResource::class,
            $this->countryService->getByCode($code))
        )->run();
    }
}
