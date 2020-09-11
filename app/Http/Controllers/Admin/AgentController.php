<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\AgentService;
use App\Http\Requests\AgentStoreRequest;

/**
 * Admin controller for agents
 */
class AgentController extends BaseController
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
        parent::__construct();
        $this->agentService = $agentService;
        $this->middleware('permission:agents-list', ['only' => ['index']]);
        $this->middleware('permission:agents-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:agents-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:agents-delete', ['only' => ['destroy']]);
        $this->middleware('permission:agents-view', ['only' => ['show']]);
    }

    /**
     * Agents index page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('admin.agents.index');
    }

    /**
     * Agents create page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('admin.agents.crud');
    }

    /**
     * Store an agent
     *
     * @param AgentStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AgentStoreRequest $request)
    {
        $this->agentService->create($request->validated());
        return redirect()->route('admin.agents.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.agents_created_successfully') ]
        ]);
    }

    /**
     * Agents edit page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $agent = $this->agentService->getByIdWith($id, 'languages');
        return view('admin.agents.crud', compact('agent'));
    }

    /**
     * Update an agent
     *
     * @param AgentStoreRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AgentStoreRequest $request, $id)
    {
        $this->agentService->update($id, $request->validated());
        return redirect()->route('admin.agents.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.agents_updated_successfully') ]
        ]);
    }

    /**
     * Agents view page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id)
    {
        $agent = $this->agentService->getById($id);
        return view('admin.agents.show', compact('agent'));
    }

    /**
     * Delete an agent
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $success = $this->agentService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
