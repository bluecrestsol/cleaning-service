<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\StaffService;
use App\Services\RoleService;
use App\Http\Requests\StaffStoreRequest;

class StaffController extends BaseController
{
    private $staffService;
    private $roleService;

    public function __construct(StaffService $staffService, RoleService $roleService)
    {
        parent::__construct();
        $this->staffService = $staffService;
        $this->roleService = $roleService;
        $this->middleware('permission:staff-list|staff-create|staff-edit|staff-delete', ['only' => ['index', 'store', 'show']]);
        $this->middleware('permission:staff-list', ['only' => ['index']]);
        $this->middleware('permission:staff-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:staff-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:staff-delete', ['only' => ['destroy']]);
        $this->middleware('permission:staff-view', ['only' => ['show']]);
    }
    
    public function index()
    {
        return view('admin.staff.index');
    }

    public function create()
    {
        $roles = $this->roleService->getOfStaff();
        return view('admin.staff.crud', compact('roles'));
    }

    public function store(StaffStoreRequest $request)
    {
        $this->staffService->create($request->validated());
        return redirect()->route('admin.staff.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.staff_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $roles = $this->roleService->getOfStaff();
        $staff = $this->staffService->getById($id);
        return view('admin.staff.crud', compact('roles', 'staff'));
    }

    public function update(StaffStoreRequest $request, $id)
    {
        $this->staffService->update($id, $request->validated());
        return redirect()->route('admin.staff.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.staff_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $staff = $this->staffService->getById($id);
        return view('admin.staff.show', compact('staff'));
    }

    public function destroy($id)
    {
        $success = $this->staffService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
