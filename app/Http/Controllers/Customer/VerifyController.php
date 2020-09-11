<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\BaseController;
use App\Http\Requests\VerifyPlaceRequest;
use App\Services\ContactRequestService;
use App\Services\PlaceService;
use Illuminate\Http\Request;

class VerifyController extends BaseController
{
    /**
     * @var PlaceService
     */
    private $placeService;

    /**
     * Initialization
     *
     * @param PlaceService $placeService
     */
    public function __construct(PlaceService $placeService)
    {
        parent::__construct();
        $this->placeService = $placeService;
    }

    /**
     * Verify page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('customer.verify.index');
    }

    /**
     * Verify result page
     *
     * @param $country
     * @param $language
     * @param $code
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function results($code)
    {
        $place = $this->placeService->getByCode($code);
        if (empty($place) && empty($place->is_listing_public) || (!empty($place->is_listing_public) && !$place->is_listing_public)) {
            return redirect()->back()->with('notification', [
                [ 'type' => 'error', 'message' => __('customer/notifications.verify_code_not_found') ]
            ]);
        }
        return view('customer.verify.result', compact('place'));
    }
}
