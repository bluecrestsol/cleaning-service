<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\CompanyResource;
use App\Services\CompanyCountryService;
use Illuminate\Http\Request;

/**
 * Api controller for countries
 */
class CountryCompanyController extends Controller
{
    /**
     * @var App\Services\CompanyCountryService $companyCountryService
     */
    protected $countryService;
    
    /**
     * Initialization
     * 
     * @param App\Services\CompanyCountryService $companyCountryService
     */
    public function __construct(CompanyCountryService $companyCountryService)
    {
        $this->countryCompanyService = $companyCountryService;
    }

    /**
     * Get company of country
     *
     * @param Request $request
     * @return App\Http\Resources\CompanyResource
     */
    public function index(Request $request, $id)
    {
        return (new BaseJsonResource(
            CompanyResource::class,
            $this->countryCompanyService->getFirstCompanyByCountry($id))
        )->run();
    }
}
