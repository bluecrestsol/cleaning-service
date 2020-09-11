<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\CityService;
use App\Services\CountryService;
use App\Services\LanguageService;
use App\Http\Requests\CityStoreRequest;

class CityController extends BaseController
{
    private $cityService;
    private $countryService;
    private $languageService;

    public function __construct(CityService $cityService, CountryService $countryService, LanguageService $languageService)
    {
        parent::__construct();
        $this->cityService = $cityService;
        $this->countryService = $countryService;
        $this->languageService = $languageService;
        $this->middleware('permission:cities-list', ['only' => ['index']]);
        $this->middleware('permission:cities-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:cities-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:cities-delete', ['only' => ['destroy']]);
        $this->middleware('permission:cities-view', ['only' => ['show']]);
    }
    
    public function index()
    {
        return view('admin.cities.index');
    }

    public function create()
    {
        $languages = $this->languageService->getPublicActive();
        $countries = $this->countryService->getActiveWhereHasCities();
        return view('admin.cities.crud', compact('languages', 'countries'));
    }

    public function store(CityStoreRequest $request)
    {
        $this->cityService->create($request->validated());
        return redirect()->route('admin.cities.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.cities_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $languages = $this->languageService->getPublicActive();
        $countries = $this->countryService->getActiveWhereHasCities();
        $city = $this->cityService->getById($id);
        return view('admin.cities.crud', compact('languages', 'countries', 'city'));
    }

    public function update(CityStoreRequest $request, $id)
    {
        $this->cityService->update($id, $request->validated());
        return redirect()->route('admin.cities.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.cities_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $languages = $this->languageService->getPublicActive();
        $city = $this->cityService->getById($id);
        return view('admin.cities.show', compact('languages', 'city'));
    }

    public function destroy($id)
    {
        $success = $this->cityService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
