<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\CustomerNoteService;
use Illuminate\Http\Request;

/**
 * Ajax controller for customers notes
 */
class CustomerNoteController extends Controller
{
    /**
     * @var CustomerNoteService $customerNoteService
     */
    private $customerNoteService;

    /**
     * Initialization
     *
     * @param CustomerNoteService $customerNoteService
     */
    public function __construct(CustomerNoteService $customerNoteService)
    {
        $this->customerNoteService = $customerNoteService;
    }

    /**
     * List of customers notes for table
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list($id, Request $request)
    {   
        $records = $this->customerNoteService->list($id, $request);
        return response()->json($records);
    }
}
