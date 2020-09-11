<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BookingStoreRequest;
use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * @var BookingService
     */
    private $bookingService;

    /**
     * Initialization
     * 
     * @param App\Services\BookingService $bookingService
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Store a contact request
     *
     * @param App\Http\Requests\Api\BookingStoreRequest $request
     * @return App\Http\Resources\BookingResource
     */
    public function store(BookingStoreRequest $request, $company)
    {
        $data = array_merge($request->validated(), ['status' => 'new', 'company_id' => $company]);
        return (new BaseJsonResource(
            BookingResource::class,
            $this->bookingService->create($data))
        )->run();
    }
}
