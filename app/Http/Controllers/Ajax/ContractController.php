<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\ContractService;
use Illuminate\Http\Request;

/**
 * Ajax controller for contracts
 */
class ContractController extends Controller
{
    /**
     * @var ContractService $contractService
     */
    private $contractService;

    /**
     * Initialization
     *
     * @param ContractService $contractService
     */
    public function __construct(ContractService $contractService)
    {
        $this->contractService = $contractService;
    }
    
    /**
     * List of contracts for table
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {   
        $records = $this->contractService->list($request);
        return response()->json($records);
    }

    /**
     * Fetch list of contracts
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch(Request $request)
    {
        $query = $request->query();
        $response['success'] = true;
        $response['data'] = $this->contractService->getAll($query);
        return response()->json($response);
    }
}
