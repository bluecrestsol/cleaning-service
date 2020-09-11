<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\ContactRequestService;
use App\Http\Requests\ContactStoreRequest;

/**
 * Admin controller for contact reequests
 */
class ContactRequestController extends BaseController
{
    /**
     * @var ContactRequestService $contactRequestService
     */
    private $agentService;

    /**
     * Initialization
     *
     * @param ContactRequestService $contactRequestService
     */
    public function __construct(ContactRequestService $contactRequestService)
    {
        parent::__construct();
        $this->contactRequestService = $contactRequestService;
        $this->middleware('permission:contact-requests-list', ['only' => ['index']]);
        $this->middleware('permission:contact-requests-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:contact-requests-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:contact-requests-delete', ['only' => ['destroy']]);
        $this->middleware('permission:contact-requests-view', ['only' => ['show']]);
    }

    /**
     * Contact requests index page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('admin.contact-requests.index');
    }

    /**
     * Contact requests edit page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $contact = $this->contactRequestService->getById($id);
        return view('admin.contact-requests.crud', compact('contact'));
    }

    /**
     * Update a contact request
     *
     * @param ContactStoreRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContactStoreRequest $request, $id)
    {
        $this->contactRequestService->update($id, $request->validated());
        return redirect()->route('admin.contact_requests.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.contact_requests_updated_successfully') ]
        ]);
    }

    /**
     * Contact requests view page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id)
    {
        $contact = $this->contactRequestService->getById($id);
        return view('admin.contact-requests.show', compact('contact'));
    }

    /**
     * Delete a contact request
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $success = $this->contactRequestService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
