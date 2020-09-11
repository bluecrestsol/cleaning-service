<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\LocaleCollection;
use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\CountryResource;
use App\Services\CountryService;
use Illuminate\Http\Request;

/**
 * Api controller for countries
 */
class LocaleController extends Controller
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
     * Get list of locales
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\LocaleCollection
     */
    public function index(Request $request)
    {
        return (new LocaleCollection($this->countryService->getAvailable()));
    }
}
