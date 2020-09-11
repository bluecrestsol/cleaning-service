<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\CompanyCountryService;
use Illuminate\Http\Request;

class CompanyCountryController extends Controller
{
    private $companyCountryService;

    public function __construct(CompanyCountryService $companyCountryService)
    {
        $this->companyCountryService = $companyCountryService;
    }

    public function list(Request $request, $id)
    {   
        $records = $this->companyCountryService->list($request, $id);
        return response()->json($records);
    }

    public function fetch($id)
    {
        $response['success'] = true;
        $response['data'] = $this->companyCountryService->getAll($id);
        return response()->json($response);
    }

    public function fetchReverse(Request $request, $id)
    {
        $response['success'] = true;
        $response['data'] = $this->companyCountryService->getNotBelongToCompany($id, $request->query('except') ?? null);
        return response()->json($response);
    }
}
