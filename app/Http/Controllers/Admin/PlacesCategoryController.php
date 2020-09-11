<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\PlacesCategoryService;
use App\Services\LanguageService;
use App\Http\Requests\PlacesCategoryStoreRequest;

class PlacesCategoryController extends BaseController
{
    private $placesCategoryService;
    private $languageService;

    public function __construct(PlacesCategoryService $placesCategoryService, LanguageService $languageService)
    {
        parent::__construct();
        $this->placesCategoryService = $placesCategoryService;
        $this->languageService = $languageService;
        $this->middleware('permission:places-categories-list', ['only' => ['index']]);
        $this->middleware('permission:places-categories-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:places-categories-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:places-categories-delete', ['only' => ['destroy']]);
        $this->middleware('permission:places-categories-view', ['only' => ['show']]);
    }
    
    public function index()
    {
        return view('admin.places.categories.index');
    }

    public function create()
    {
        $languages = $this->languageService->getPublicActive();
        return view('admin.places.categories.crud', compact('languages'));
    }

    public function store(PlacesCategoryStoreRequest $request)
    {
        $this->placesCategoryService->create($request->validated());
        return redirect()->route('admin.places.categories.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.places_categories_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $languages = $this->languageService->getPublicActive();
        $placesCategory = $this->placesCategoryService->getById($id);
        return view('admin.places.categories.crud', compact('languages', 'placesCategory'));
    }

    public function update(PlacesCategoryStoreRequest $request, $id)
    {
        $this->placesCategoryService->update($id, $request->validated());
        return redirect()->route('admin.places.categories.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.places_categories_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $languages = $this->languageService->getPublicActive();
        $placesCategory = $this->placesCategoryService->getById($id);
        return view('admin.places.categories.show', compact('languages', 'placesCategory'));
    }

    public function destroy($id)
    {
        $success = $this->placesCategoryService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
