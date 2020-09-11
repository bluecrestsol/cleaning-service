<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\CountryService;
use App\Http\Requests\CountryStoreRequest;

class CountryController extends BaseController
{
    private $countryService;

    public function __construct(CountryService $countryService)
    {
        parent::__construct();
        $this->countryService = $countryService;
        $this->middleware('permission:countries-list|countries-create|countries-edit|countries-delete', ['only' => ['index', 'store', 'show']]);
        $this->middleware('permission:countries-list', ['only' => ['index']]);
        $this->middleware('permission:countries-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:countries-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:countries-delete', ['only' => ['destroy']]);
        $this->middleware('permission:countries-view', ['only' => ['show']]);
    }

    public function index()
    {
        return view('admin.countries.index');
    }

    public function create()
    {
        return view('admin.countries.crud');
    }

    public function store(CountryStoreRequest $request)
    {
        $this->countryService->create($request->validated());
        return redirect()->route('admin.countries.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.countries_added_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $country = $this->countryService->getById($id);
        return view('admin.countries.crud', compact('country'));
    }

    public function update(CountryStoreRequest $request, $id)
    {
        $this->countryService->update($id, $request->validated());
        return redirect()->route('admin.countries.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.countries_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $country = $this->countryService->getById($id);
        return view('admin.countries.show', compact('country'));
    }

    public function destroy($id)
    {
        $success = $this->countryService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
