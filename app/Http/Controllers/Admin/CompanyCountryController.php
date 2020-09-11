<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\CompanyService;
use App\Services\CompanyCountryService;
use App\Http\Requests\CompanyCountryStoreRequest;

class CompanyCountryController extends BaseController
{
    private $companyService;

    public function __construct(CompanyService $companyService, CompanyCountryService $companyCountryService)
    {
        parent::__construct();
        $this->companyService = $companyService;
        $this->companyCountryService = $companyCountryService;
        $this->middleware('permission:companies-countries-list', ['only' => ['index']]);
        $this->middleware('permission:companies-countries-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:companies-countries-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:companies-countries-delete', ['only' => ['destroy']]);
        $this->middleware('permission:companies-countries-view', ['only' => ['show']]);
    }
    
    public function index($id)
    {
        $company = $this->companyService->getById($id);
        return view('admin.companies.countries.index', compact('company'));
    }

    public function create($companyId)
    {
        $company = $this->companyService->getById($companyId);
        return view('admin.companies.countries.crud', compact('company'));
    }

    public function store(CompanyCountryStoreRequest $request, $companyId)
    {
        $this->companyCountryService->create($companyId, $request->validated());
        return redirect()->route('admin.companies.countries.index', $companyId)->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.companies_countries_added_successfully') ]
        ]);
    }

    public function edit($companyId, $countryId)
    {
        $company = $this->companyService->getById($companyId);
        $country = $this->companyCountryService->getById($companyId, $countryId);
        return view('admin.companies.countries.crud', compact('company', 'country'));
    }

    public function update(CompanyCountryStoreRequest $request, $companyId, $countryId)
    {
        $this->companyCountryService->update($companyId, $countryId, $request->validated());
        return redirect()->route('admin.companies.countries.index', $companyId)->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.companies_countries_updated_successfully') ]
        ]);
    }

    public function destroy($companyId, $countryId)
    {
        $success = $this->companyCountryService->delete($companyId, $countryId);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
