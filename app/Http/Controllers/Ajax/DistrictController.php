<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\DistrictService;
use Illuminate\Http\Request;
use App\Http\Resources\LocaleCollection;

class DistrictController extends Controller
{
    private $districtService;

    public function __construct(DistrictService $districtService)
    {
        $this->districtService = $districtService;
    }

    public function list(Request $request)
    {
        $records = $this->districtService->list($request);
        $records['data'] = new LocaleCollection($records['data']);
        return response()->json($records);
    }

    public function fetch(Request $request)
    {
        return (new LocaleCollection($this->districtService->getAll($request->query())))
            ->additional(['success' => true]);
    }
}
