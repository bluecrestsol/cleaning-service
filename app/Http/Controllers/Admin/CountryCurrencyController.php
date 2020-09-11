<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\CountryService;
use App\Services\CountryCurrencyService;
use App\Services\CurrencyService;
use App\Http\Requests\CountryCurrencyStoreRequest;

class CountryCurrencyController extends BaseController
{
    private $countryService;
    private $countryCurrencyService;
    private $currencyService;

    public function __construct(CountryService $countryService,  CountryCurrencyService $countryCurrencyService,
        CurrencyService $currencyService)
    {
        parent::__construct();
        $this->countryService = $countryService;
        $this->countryCurrencyService = $countryCurrencyService;
        $this->currencyService = $currencyService;
        $this->middleware('permission:countries-currencies-list|countries-currencies-create|countries-currencies-edit|countries-currencies-delete', ['only' => ['index', 'store', 'show']]);
        $this->middleware('permission:countries-currencies-list', ['only' => ['index']]);
        $this->middleware('permission:countries-currencies-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:countries-currencies-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:countries-currencies-delete', ['only' => ['destroy']]);
        $this->middleware('permission:countries-currencies-view', ['only' => ['show']]);
    }
    
    public function index($id)
    {
        $country = $this->countryService->getById($id);
        return view('admin.countries.currencies.index', compact('country'));
    }

    public function create($countryId)
    {
        $country = $this->countryService->getById($countryId);
        return view('admin.countries.currencies.crud', compact('country'));
    }

    public function store(CountryCurrencyStoreRequest $request, $countryId)
    {
        $this->countryCurrencyService->create($countryId, $request->validated());
        return redirect()->route('admin.countries.currencies.index', $countryId)->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.countries_currencies_added_successfully') ]
        ]);
    }

    public function edit($countryId, $currencyId)
    {
        $country = $this->countryService->getById($countryId);
        $currency = $this->countryCurrencyService->getById($countryId, $currencyId);
        return view('admin.countries.currencies.crud', compact('country', 'currency'));
    }

    public function update(CountryCurrencyStoreRequest $request, $countryId, $currencyId)
    {
        $this->countryCurrencyService->update($countryId, $currencyId, $request->validated());
        return redirect()->route('admin.countries.currencies.index', $countryId)->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.countries_currencies_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $currency = $this->currencyService->getById($id);
        return view('admin.countries.currencies.show', compact('currency'));
    }

    public function destroy($countryId, $currencyId)
    {
        $success = $this->countryCurrencyService->delete($countryId, $currencyId);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
