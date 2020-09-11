<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function list(Request $request)
    {   
        $records = $this->countryService->list($request);
        return response()->json($records);
    }
    
    public function fetch(Request $request)
    {
        $query = $request->query();
        $response['success'] = true;
        $response['data'] = $this->countryService->getAll($query);
        return response()->json($response);
    }
}
