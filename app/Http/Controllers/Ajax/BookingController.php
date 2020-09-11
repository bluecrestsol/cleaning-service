<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingCollection;
use App\Http\Requests\BookingStoreRequest;
use App\Services\BookingService;
use Illuminate\Http\Request;

/**
 * Ajax controller for bookings
 */
class BookingController extends Controller
{
    /**
     * @var BookingService $bookingService
     */
    private $bookingService;

    /**
     * Initialization
     *
     * @param BookingService $bookingService
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * List of bookings for table
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $records = $this->bookingService->list($request);
        $records['data'] = (new BookingCollection($records['data']));
        return $records;
    }

    /**
     * Store a booking
     *
     * @param BookingStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BookingStoreRequest $request)
    {
        $booking = $this->bookingService->create($request->validated());
        return response()->json($booking);
    }
}
