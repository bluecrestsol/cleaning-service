<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\BookingService;
use App\Http\Requests\BookingStoreRequest;

class BookingController extends BaseController
{
    private $bookingService;

    public function __construct(BookingService $bookingService)
    {
        parent::__construct();
        $this->bookingService = $bookingService;
        $this->middleware('permission:bookings-list', ['only' => ['index']]);
        $this->middleware('permission:bookings-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:bookings-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:bookings-delete', ['only' => ['destroy']]);
        $this->middleware('permission:bookings-view', ['only' => ['show']]);
    }

    public function index()
    {
        return view('admin.bookings.index');
    }

    public function edit($id)
    {
        $booking = $this->bookingService->getById($id);
        return view('admin.bookings.crud', compact('booking'));
    }

    public function update(BookingStoreRequest $request, $id)
    {
        $this->bookingService->update($id, $request->validated());
        return redirect()->route('admin.bookings.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.bookings_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $booking = $this->bookingService->getById($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function destroy($id)
    {
        $success = $this->bookingService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
