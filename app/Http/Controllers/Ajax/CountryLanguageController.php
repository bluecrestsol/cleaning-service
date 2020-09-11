<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\CountryLanguageService;
use Illuminate\Http\Request;

class CountryLanguageController extends Controller
{
    private $countryLanguageService;

    public function __construct(CountryLanguageService $countryLanguageService)
    {
        $this->countryLanguageService = $countryLanguageService;
    }

    public function list(Request $request, $id)
    {   
        $records = $this->countryLanguageService->list($request, $id);
        return response()->json($records);
    }

    public function fetch(Request $request, $id)
    {
        $response['success'] = true;
        $response['data'] = $this->countryLanguageService->getAll($id, $request->query());
        return response()->json($response);
    }

    public function fetchReverse(Request $request, $id)
    {
        $response['success'] = true;
        $response['data'] = $this->countryLanguageService->getNotBelongToCountry($id, $request->query('except') ?? null);
        return response()->json($response);
    }
}
