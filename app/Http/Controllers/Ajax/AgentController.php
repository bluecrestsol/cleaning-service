<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\AgentService;
use Illuminate\Http\Request;

/**
 * Ajax controller for agents
 */
class AgentController extends Controller
{
    /**
     * @var AgentService $agentService
     */
    private $agentService;

    /**
     * Initialization
     *
     * @param AgentService $agentService
     */
    public function __construct(AgentService $agentService)
    {
        $this->agentService = $agentService;
    }

    /**
     * List of agents for table
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {   
        $records = $this->agentService->list($request);
        return response()->json($records);
    }

    /**
     * Fetch list of agents
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch(Request $request)
    {
        $query = $request->query();
        $response['success'] = true;
        $response['data'] = $this->agentService->getAll($query);
        return response()->json($response);
    }
}
