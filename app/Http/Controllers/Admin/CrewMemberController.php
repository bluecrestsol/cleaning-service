<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\CrewMemberService;
use App\Http\Requests\CrewMemberStoreRequest;

class CrewMemberController extends BaseController
{
    private $crewMemberService;

    public function __construct(CrewMemberService $crewMemberService)
    {
        parent::__construct();
        $this->crewMemberService = $crewMemberService;
        $this->middleware('permission:crew-members-list', ['only' => ['index']]);
        $this->middleware('permission:crew-members-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:crew-members-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:crew-members-delete', ['only' => ['destroy']]);
        $this->middleware('permission:crew-members-view', ['only' => ['show']]);
    }
    
    public function index()
    {
        return view('admin.crew-members.index');
    }

    public function create()
    {
        return view('admin.crew-members.crud');
    }

    public function store(CrewMemberStoreRequest $request)
    {
        $this->crewMemberService->create($request->validated());
        return redirect()->route('admin.crew_members.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.crew_members_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $crewMember = $this->crewMemberService->getByIdWith($id, 'languages');
        return view('admin.crew-members.crud', compact('crewMember'));
    }

    public function update(CrewMemberStoreRequest $request, $id)
    {
        $this->crewMemberService->update($id, $request->validated());
        return redirect()->route('admin.crew_members.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.crew_members_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $crewMember = $this->crewMemberService->getById($id);
        return view('admin.crew-members.show', compact('crewMember'));
    }

    public function destroy($id)
    {
        $success = $this->crewMemberService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
