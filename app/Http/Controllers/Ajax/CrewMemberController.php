<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\CrewMemberService;
use Illuminate\Http\Request;

class CrewMemberController extends Controller
{
    private $crewMemberService;

    public function __construct(CrewMemberService $crewMemberService)
    {
        $this->crewMemberService = $crewMemberService;
    }
    
    public function list(Request $request)
    {   
        $records = $this->crewMemberService->list($request);
        return response()->json($records);
    }

    public function fetch(Request $request)
    {
        $query = $request->query();
        $response['success'] = true;
        $response['data'] = $this->crewMemberService->getAll($query);
        return response()->json($response);
    }
}
