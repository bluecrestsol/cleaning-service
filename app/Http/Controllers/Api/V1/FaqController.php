<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\FaqCategoryCollection;
use App\Services\FaqCategoryService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * @var FaqCategoryService
     */
    private $faqCategoryService;

    /**
     * Initialization
     * 
     * @param App\Services\FaqCategoryService $faqCategoryService
     */
    public function __construct(FaqCategoryService $faqCategoryService)
    {
        $this->faqCategoryService = $faqCategoryService;
    }

    /**
     * Get list of faqs
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\FaqCategoryCollection
     */
    public function index(Request $request, $country)
    {
        return (new FaqCategoryCollection($this->faqCategoryService->getWithQuestions([
            'country' => $country,
            'status' => 'enabled',
            'order' => [['column' => 'order', 'dir' => 'asc']],
            'questions_status' => 'enabled',
            'questions_order' => [['column' => 'order', 'dir' => 'asc']]
        ])));
    }
}
