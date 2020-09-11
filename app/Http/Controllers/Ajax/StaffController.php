<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\StaffService;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    private $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }
    
    public function list(Request $request)
    {   
        $records = $this->staffService->list($request);
        return response()->json($records);
    }
}
