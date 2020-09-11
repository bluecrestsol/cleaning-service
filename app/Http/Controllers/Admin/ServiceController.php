<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\ServiceService;
use App\Services\LanguageService;
use App\Http\Requests\ServiceStoreRequest;

/**
 * Admin controller for services
 */
class ServiceController extends BaseController
{
    /**
     * @var ServiceService $serviceService
     * @var LanguageService $languageService
     */
    private $serviceService, $languageService;

    /**
     * Initialization
     *
     * @param ServiceService $serviceService
     * @param LanguageService $languageService
     */
    public function __construct(ServiceService $serviceService, LanguageService $languageService)
    {
        parent::__construct();
        $this->serviceService = $serviceService;
        $this->languageService = $languageService;
        $this->middleware('permission:services-list', ['only' => ['index']]);
        $this->middleware('permission:services-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:services-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:services-delete', ['only' => ['destroy']]);
        $this->middleware('permission:services-view', ['only' => ['show']]);
    }

    /**
     * Services index page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('admin.services.index');
    }

    /**
     * Services create page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $languages = $this->languageService->getPublicActive();
        return view('admin.services.crud', compact('languages'));
    }

    /**
     * Store an service
     *
     * @param ServiceStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ServiceStoreRequest $request)
    {
        $this->serviceService->create($request->validated());
        return redirect()->route('admin.services.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.services_created_successfully') ]
        ]);
    }

    /**
     * Services edit page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $languages = $this->languageService->getPublicActive();
        $service = $this->serviceService->getById($id);
        return view('admin.services.crud', compact('languages', 'service'));
    }

    /**
     * Update an service
     *
     * @param ServiceStoreRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ServiceStoreRequest $request, $id)
    {
        $this->serviceService->update($id, $request->validated());
        return redirect()->route('admin.services.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.services_updated_successfully') ]
        ]);
    }

    /**
     * Services view page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id)
    {
        $languages = $this->languageService->getPublicActive();
        $service = $this->serviceService->getById($id);
        return view('admin.services.show', compact('languages', 'service'));
    }

    /**
     * Delete an service
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $success = $this->serviceService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
