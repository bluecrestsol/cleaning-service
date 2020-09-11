<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\ContractService;
use App\Http\Requests\ContractStoreRequest;

class ContractController extends BaseController
{
    private $contractService;

    public function __construct(ContractService $contractService)
    {
        parent::__construct();
        $this->contractService = $contractService;
        $this->middleware('permission:contracts-list', ['only' => ['index']]);
        $this->middleware('permission:contracts-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:contracts-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:contracts-delete', ['only' => ['destroy']]);
        $this->middleware('permission:contracts-view', ['only' => ['show']]);
    }
    
    public function index()
    {
        return view('admin.contracts.index');
    }

    public function create()
    {
        return view('admin.contracts.crud');
    }

    public function store(ContractStoreRequest $request)
    {
        $this->contractService->create($request->validated());
        return redirect()->route('admin.contracts.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.contracts_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $contract = $this->contractService->getById($id);
        return view('admin.contracts.crud', compact('contract'));
    }

    public function update(ContractStoreRequest $request, $id)
    {
        $this->contractService->update($id, $request->validated());
        return redirect()->route('admin.contracts.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.contracts_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $contract = $this->contractService->getById($id);
        return view('admin.contracts.show', compact('contract'));
    }

    /**
     * Delete a customer
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $success = $this->contractService->delete($id);
        $response = [
            'success' => $success,
            'message' => __('staff/notifications.contracts_cannot_delete')
        ];
        return response()->json($response);
    }
}
