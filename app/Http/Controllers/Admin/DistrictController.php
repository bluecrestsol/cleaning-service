<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\DistrictService;
use App\Services\CountryService;
use App\Services\LanguageService;
use App\Http\Requests\DistrictStoreRequest;

class DistrictController extends BaseController
{
    private $districtService;
    private $countryService;
    private $languageService;

    public function __construct(DistrictService $districtService, CountryService $countryService, LanguageService $languageService)
    {
        parent::__construct();
        $this->districtService = $districtService;
        $this->countryService = $countryService;
        $this->languageService = $languageService;
        $this->middleware('permission:districts-list', ['only' => ['index']]);
        $this->middleware('permission:districts-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:districts-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:districts-delete', ['only' => ['destroy']]);
        $this->middleware('permission:districts-view', ['only' => ['show']]);
    }
    
    public function index()
    {
        return view('admin.districts.index');
    }

    public function create()
    {
        $languages = $this->languageService->getPublicActive();
        $countries = $this->countryService->getActiveWhereHasDistricts();
        return view('admin.districts.crud', compact('languages', 'countries'));
    }

    public function store(DistrictStoreRequest $request)
    {
        $this->districtService->create($request->validated());
        return redirect()->route('admin.districts.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.districts_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $languages = $this->languageService->getPublicActive();
        $countries = $this->countryService->getActiveWhereHasDistricts();
        $district = $this->districtService->getById($id);
        return view('admin.districts.crud', compact('languages', 'countries', 'district'));
    }

    public function update(DistrictStoreRequest $request, $id)
    {
        $this->districtService->update($id, $request->validated());
        return redirect()->route('admin.districts.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.districts_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $languages = $this->languageService->getPublicActive();
        $district = $this->districtService->getById($id);
        return view('admin.districts.show', compact('languages', 'district'));
    }

    public function destroy($id)
    {
        $success = $this->districtService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
