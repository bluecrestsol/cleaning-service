<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\CustomerService;
use App\Services\CustomerNoteService;
use App\Http\Requests\NoteStoreRequest;

/**
 * Admin controller for customers
 */
class CustomerNoteController extends BaseController
{
    /**
     * @var CustomerService $customerService
     * @var CustomerNoteService $customerNoteService
     */
    private $customerService, $customerNoteService;

    /**
     * Initialization
     *
     * @var CustomerService $customerService
     * @param CustomerNoteService $customerNoteService
     */
    public function __construct(CustomerService $customerService, CustomerNoteService $customerNoteService)
    {
        parent::__construct();
        $this->customerService = $customerService;
        $this->customerNoteService = $customerNoteService;
        $this->middleware('permission:customers-notes-list', ['only' => ['index']]);
        $this->middleware('permission:customers-notes-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customers-notes-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customers-notes-delete', ['only' => ['destroy']]);
        $this->middleware('permission:customers-notes-view', ['only' => ['show']]);
    }

    /**
     * Customers notes index page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($id)
    {
        $customer = $this->customerService->getById($id);
        return view('admin.customers.notes.index', compact('customer'));
    }

    /**
     * Agents create page
     *
     * @param int $customerId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create($customerId)
    {
        $customer = $this->customerService->getById($customerId);
        return view('admin.customers.notes.crud', compact('customer'));
    }

    /**
     * Store a customers note
     *
     * @param NoteStoreRequest $request
     * @param int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NoteStoreRequest $request, $customerId)
    {
        $this->customerNoteService->create($customerId, $request->validated());
        return redirect()->route('admin.customers.notes.index', $customerId)->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.customers_notes_added_successfully') ]
        ]);
    }

    /**
     * Delete a customer note
     *
     * @param int $customerId
     * @param int $noteId
     * @return void
     */
    public function destroy($customerId, $noteId)
    {
        $success = $this->customerNoteService->delete($customerId, $noteId);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
