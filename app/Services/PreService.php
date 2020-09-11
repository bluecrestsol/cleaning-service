<?php

namespace App\Services;

use App\Services\StaffService;
use App\Services\CompanyCountryService;

class PreService
{
    protected $staffService;
    protected $countryService;
    protected $companyCountryService;

    public function __construct(StaffService $staffService, CompanyCountryService $companyCountryService)
	{
        $this->staffService = $staffService;
        $this->companyCountryService = $companyCountryService;
    }

    public function forPublic()
    {
        $main = app('shared')->get('main');
        $main['company'] = $this->companyCountryService->getFirstCompanyByCountry($main['country']->id);
        app('shared')->set('main', $main);
    }

    public function forAdmin()
    {
        $admin = $this->staffService->getCurrent();
        if (isset($admin)) {
            $timezones = getTimeZoneByCountry($admin->active_country->code);
            $others = ['timezone' => $timezones[0] ?? null];
            app('shared')->set('admin', $admin);
            app('shared')->set('others', $others);
        }
    }
}