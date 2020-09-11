<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\LanguageService;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    protected $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    public function list(Request $request)
    {   
        $records = $this->languageService->list($request);
        return response()->json($records);
    }

    public function fetch(Request $request)
    {
        $query = $request->query();
        $response['success'] = true;
        $response['data'] = $this->languageService->getAll($query);
        return response()->json($response);
    }
}
