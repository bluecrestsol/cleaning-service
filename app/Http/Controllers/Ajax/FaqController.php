<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\FaqService;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use App\Http\Resources\LocaleCollection;

/**
 * Ajax controller for FAQs questions
 */
class FaqController extends Controller
{
    /**
     * @var FaqService $faqService
     * @var LanguageService $languageService
     */
    private $faqService, $languageService;

    /**
     * Initialization
     *
     * @param FaqService $faqService
     * @param LanguageService $languageService
     */
    public function __construct(FaqService $faqService, LanguageService $languageService)
    {
        $this->faqService = $faqService;
        $this->languageService = $languageService;
    }

    /**
     * List of FAQs questions for table
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {   
        $records = $this->faqService->list($request);
        $records['data'] = new LocaleCollection($records['data']);
        $records['others'] = [
            'languages_count' => $this->languageService->countPublicActive()
        ];
        return response()->json($records);
    }
}
