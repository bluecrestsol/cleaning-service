<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\AppointmentService;
use App\Http\Requests\AppointmentStoreRequest;
use Illuminate\Http\Request;

class AppointmentController extends BaseController
{
    private $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        parent::__construct();
        $this->appointmentService = $appointmentService;
        $this->middleware('permission:appointments-list', ['only' => ['index']]);
        $this->middleware('permission:appointments-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:appointments-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:appointments-delete', ['only' => ['destroy']]);
        $this->middleware('permission:appointments-view', ['only' => ['show']]);
    }
    
    /**
     * Appointments index page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $place = $request->query('place');
        $crewMember = $request->query('crew_member');
        return view('admin.appointments.index', compact('place', 'crewMember'));
    }

    public function create()
    {
        return view('admin.appointments.crud');
    }

    public function store(AppointmentStoreRequest $request)
    {
        $this->appointmentService->create($request->validated());
        return redirect()->route('admin.appointments.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.appointments_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $appointment = $this->appointmentService->getByIdWith($id, ['services', 'crew_members']);
        return view('admin.appointments.crud', compact('appointment'));
    }

    public function update(AppointmentStoreRequest $request, $id)
    {
        $this->appointmentService->update($id, $request->validated());
        return redirect()->route('admin.appointments.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.appointments_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $appointment = $this->appointmentService->getById($id);
        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy($id)
    {
        $success = $this->appointmentService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
