<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\CountryService;
use App\Services\CountryLanguageService;
use App\Services\LanguageService;
use App\Http\Requests\CountryLanguageStoreRequest;

class CountryLanguageController extends BaseController
{
    private $countryService;
    private $countryLanguageService;
    private $languageService;

    public function __construct(CountryService $countryService, CountryLanguageService $countryLanguageService,
        LanguageService $languageService)
    {
        parent::__construct();
        $this->countryService = $countryService;
        $this->countryLanguageService = $countryLanguageService;
        $this->languageService = $languageService;
        $this->middleware('permission:countries-languages-list|countries-languages-create|countries-languages-edit|countries-languages-delete', ['only' => ['index', 'store', 'show']]);
        $this->middleware('permission:countries-languages-list', ['only' => ['index']]);
        $this->middleware('permission:countries-languages-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:countries-languages-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:countries-languages-delete', ['only' => ['destroy']]);
        $this->middleware('permission:countries-languages-view', ['only' => ['show']]);
    }
    
    public function index($id)
    {
        $country = $this->countryService->getById($id);
        return view('admin.countries.languages.index', compact('country'));
    }

    public function create($countryId)
    {
        $country = $this->countryService->getById($countryId);
        return view('admin.countries.languages.crud', compact('country'));
    }

    public function store(CountryLanguageStoreRequest $request, $countryId)
    {
        $this->countryLanguageService->create($countryId, $request->validated());
        return redirect()->route('admin.countries.languages.index', $countryId)->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.countries_languages_added_successfully') ]
        ]);
    }

    public function edit($countryId, $languageId)
    {
        $country = $this->countryService->getById($countryId);
        $language = $this->countryLanguageService->getById($countryId, $languageId);
        return view('admin.countries.languages.crud', compact('country', 'language'));
    }

    public function update(CountryLanguageStoreRequest $request, $countryId, $languageId)
    {
        $this->countryLanguageService->update($countryId, $languageId, $request->validated());
        return redirect()->route('admin.countries.languages.index', $countryId)->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.countries_languages_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $language = $this->languageService->getById($id);
        return view('admin.countries.languages.show', compact('language'));
    }

    public function destroy($countryId, $languageId)
    {
        $success = $this->countryLanguageService->delete($countryId, $languageId);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
