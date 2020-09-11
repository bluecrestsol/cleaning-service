<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\PlaceService;
use App\Services\CountryService;
use Illuminate\Http\Request;
use App\Http\Requests\PlaceStoreRequest;

/**
 * Admin controller for places
 */
class PlaceController extends BaseController
{
    /**
     * @var PlaceService $placeService
     * @var CountryService $countryService
     */
    private $placeService;
    private $countryService;

    /**
     * Initialization
     *
     * @var PlaceService $placeService
     * @param CountryService $countryService
     */
    public function __construct(PlaceService $placeService, CountryService $countryService)
    {
        parent::__construct();
        $this->placeService = $placeService;
        $this->countryService = $countryService;
        $this->middleware('permission:places-list', ['only' => ['index']]);
        $this->middleware('permission:places-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:places-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:places-delete', ['only' => ['destroy']]);
        $this->middleware('permission:places-view', ['only' => ['show']]);
    }
    
    /**
     * Places index page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $customer = $request->query('customer');
        $agent = $request->query('agent');
        return view('admin.places.index', compact('customer', 'agent'));
    }

    public function create()
    {
        $country = $this->countryService->getById(app('shared')->get('admin')->active_country_id);
        return view('admin.places.crud', compact('country'));
    }

    public function store(PlaceStoreRequest $request)
    {
        $this->placeService->create($request->validated());
        return redirect()->route('admin.places.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.places_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $country = $this->countryService->getById(app('shared')->get('admin')->active_country_id);
        $place = $this->placeService->getById($id);
        return view('admin.places.crud', compact('country', 'place'));
    }

    public function update(PlaceStoreRequest $request, $id)
    {
        $this->placeService->update($id, $request->validated());
        return redirect()->route('admin.places.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.places_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $country = $this->countryService->getById(app('shared')->get('admin')->active_country_id);
        $place = $this->placeService->getById($id);
        return view('admin.places.show', compact('country', 'place'));
    }

    /**
     * Delete a place
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $success = $this->placeService->delete($id);
        $response = [
            'success' => $success,
            'message' => __('staff/notifications.places_cannot_delete')
        ];
        return response()->json($response);
    }
}
