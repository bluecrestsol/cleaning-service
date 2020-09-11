<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\StateService;
use App\Services\CountryService;
use App\Services\LanguageService;
use App\Http\Requests\StateStoreRequest;

class StateController extends BaseController
{
    private $stateService;
    private $countryService;
    private $languageService;

    public function __construct(StateService $stateService, CountryService $countryService, LanguageService $languageService)
    {
        parent::__construct();
        $this->stateService = $stateService;
        $this->countryService = $countryService;
        $this->languageService = $languageService;
        $this->middleware('permission:states-list', ['only' => ['index']]);
        $this->middleware('permission:states-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:states-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:states-delete', ['only' => ['destroy']]);
        $this->middleware('permission:states-view', ['only' => ['show']]);
    }
    
    public function index()
    {
        return view('admin.states.index');
    }

    public function create()
    {
        $languages = $this->languageService->getPublicActive();
        $countries = $this->countryService->getActiveWhereHasStates();
        return view('admin.states.crud', compact('languages', 'countries'));
    }

    public function store(StateStoreRequest $request)
    {
        $this->stateService->create($request->validated());
        return redirect()->route('admin.states.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.states_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $languages = $this->languageService->getPublicActive();
        $countries = $this->countryService->getActiveWhereHasStates();
        $state = $this->stateService->getById($id);
        return view('admin.states.crud', compact('languages', 'countries', 'state'));
    }

    public function update(StateStoreRequest $request, $id)
    {
        $this->stateService->update($id, $request->validated());
        return redirect()->route('admin.states.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.states_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $languages = $this->languageService->getPublicActive();
        $state = $this->stateService->getById($id);
        return view('admin.states.show', compact('languages', 'state'));
    }

    public function destroy($id)
    {
        $success = $this->stateService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
