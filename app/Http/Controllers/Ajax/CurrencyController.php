<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    private $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function list(Request $request)
    {
        $records = $this->currencyService->list($request);
        return response()->json($records);
    }

    public function fetch(Request $request)
    {
        $query = $request->query();
        $response['success'] = true;
        $response['data'] = $this->currencyService->getAll($query);
        return response()->json($response);
    }
}
