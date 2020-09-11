<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\CityService;
use Illuminate\Http\Request;
use App\Http\Resources\LocaleCollection;

class CityController extends Controller
{
    private $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }
    
    public function list(Request $request)
    {   
        $records = $this->cityService->list($request);
        $records['data'] = new LocaleCollection($records['data']);
        return response()->json($records);
    }

    public function fetch(Request $request)
    {
        $query = $request->query();
        return (new LocaleCollection($this->cityService->getAll($query)))
            ->additional(['success' => true]);
    }
}
