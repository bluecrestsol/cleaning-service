<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\CompanyService;
use App\Http\Requests\CompanyStoreRequest;

class CompanyController extends BaseController
{
    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        parent::__construct();
        $this->companyService = $companyService;
        $this->middleware('permission:companies-list', ['only' => ['index']]);
        $this->middleware('permission:companies-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:companies-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:companies-delete', ['only' => ['destroy']]);
        $this->middleware('permission:companies-view', ['only' => ['show']]);
    }
    
    public function index()
    {
        return view('admin.companies.index');
    }

    public function create()
    {
        return view('admin.companies.crud');
    }

    public function store(CompanyStoreRequest $request)
    {
        $this->companyService->create($request->validated());
        return redirect()->route('admin.companies.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.companies_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $company = $this->companyService->getById($id);
        return view('admin.companies.crud', compact('company'));
    }

    public function update(CompanyStoreRequest $request, $id)
    {
        $this->companyService->update($id, $request->validated());
        return redirect()->route('admin.companies.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.companies_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $company = $this->companyService->getById($id);
        return view('admin.companies.show', compact('company'));
    }

    public function destroy($id)
    {
        $success = $this->companyService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
