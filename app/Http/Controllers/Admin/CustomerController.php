<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\CustomerService;
use App\Services\CountryService;
use App\Http\Requests\CustomerStoreRequest;

class CustomerController extends BaseController
{
    private $customerService;
    private $countryService;

    public function __construct(CustomerService $customerService, CountryService $countryService)
    {
        parent::__construct();
        $this->customerService = $customerService;
        $this->countryService = $countryService;
        $this->middleware('permission:customers-list', ['only' => ['index']]);
        $this->middleware('permission:customers-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customers-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customers-delete', ['only' => ['destroy']]);
        $this->middleware('permission:customers-view', ['only' => ['show']]);
    }
    
    public function index()
    {
        return view('admin.customers.index');
    }

    public function create()
    {
        return view('admin.customers.crud');
    }

    public function store(CustomerStoreRequest $request)
    {
        $this->customerService->create($request->validated());
        return redirect()->route('admin.customers.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.customers_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $customer = $this->customerService->getById($id);
        return view('admin.customers.crud', compact('customer'));
    }

    public function update(CustomerStoreRequest $request, $id)
    {
        $this->customerService->update($id, $request->validated());
        return redirect()->route('admin.customers.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.customers_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $customer = $this->customerService->getById($id);
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Delete a customer
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $success = $this->customerService->delete($id);
        $response = [
            'success' => $success,
            'message' => __('staff/notifications.customers_cannot_delete')
        ];
        return response()->json($response);
    }
}
