<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\BaseController;
use App\Services\PlacesCategoryService;
use Illuminate\Http\Request;

class BookingController extends BaseController
{
    private $placesCategoryService;

    public function __construct(PlacesCategoryService $placesCategoryService)
    {
        parent::__construct();
        $this->placesCategoryService = $placesCategoryService;
    }

    public function index(Request $request)
    {
        $main = app('shared')->get('main');

        $placesCategory = $this->placesCategoryService->getAll($request->query());
        
        return view('customer.bookings.index', compact('placesCategory', 'main'));
    }
}
