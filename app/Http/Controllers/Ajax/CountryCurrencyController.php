<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\CountryCurrencyService;
use Illuminate\Http\Request;

class CountryCurrencyController extends Controller
{
    private $countryCurrencyService;

    public function __construct(CountryCurrencyService $countryCurrencyService)
    {
        $this->countryCurrencyService = $countryCurrencyService;
    }

    public function list(Request $request, $id)
    {   
        $records = $this->countryCurrencyService->list($request, $id);
        return response()->json($records);
    }

    public function fetch($id)
    {
        $response['success'] = true;
        $response['data'] = $this->countryCurrencyService->getAll($id);
        return response()->json($response);
    }

    public function fetchReverse(Request $request, $id)
    {
        $response['success'] = true;
        $response['data'] = $this->countryCurrencyService->getNotBelongToCountry($id, $request->query('except') ?? null);
        return response()->json($response);
    }
}
