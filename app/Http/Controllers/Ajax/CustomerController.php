<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use App\Http\Resources\BillingDetailResource;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }
    
    public function list(Request $request)
    {   
        $records = $this->customerService->list($request);
        return response()->json($records);
    }

    public function fetch(Request $request)
    {
        $query = $request->query();
        $response['success'] = true;
        $response['data'] = $this->customerService->getAll($query);
        return response()->json($response);
    }

    public function getBillingDetails($id)
    {
        $response['success'] = true;
        $billing_details = $this->customerService->getBillingDetailsById($id);
        return (new BillingDetailResource($billing_details))
            ->additional(['success' => true]);
    }
}
