<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\StateService;
use Illuminate\Http\Request;
use App\Http\Resources\LocaleCollection;

class StateController extends Controller
{
    private $stateService;

    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }
    
    public function list(Request $request)
    {   
        $records = $this->stateService->list($request);
        $records['data'] = new LocaleCollection($records['data']);
        return response()->json($records);
    }

    public function fetch(Request $request)
    {
        $query = $request->query();
        return (new LocaleCollection($this->stateService->getAll($query)))
            ->additional(['success' => true]);
    }
}
