<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\FaqCategoryService;
use App\Services\LanguageService;
use App\Http\Requests\FaqCategoryStoreRequest;

/**
 * Ajax controller for FAQs categories
 */
class FaqCategoryController extends BaseController
{
    /**
     * @var FaqCategoryService $faqCategoryService
     * @var LanguageService $languageService
     */
    private $faqCategoryService, $languageService;

    /**
     * Initialization
     *
     * @param FaqCategoryService $faqCategoryService
     * @param LanguageService $languageService
     */
    public function __construct(FaqCategoryService $faqCategoryService, LanguageService $languageService)
    {
        parent::__construct();
        $this->faqCategoryService = $faqCategoryService;
        $this->languageService = $languageService;
        $this->middleware('permission:faqs-categories-list', ['only' => ['index']]);
        $this->middleware('permission:faqs-categories-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:faqs-categories-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:faqs-categories-delete', ['only' => ['destroy']]);
        $this->middleware('permission:faqs-categories-view', ['only' => ['show']]);
    }

    /**
     * FAQs categories page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('admin.faqs.categories.index');
    }

    /**
     * FAQs categories create page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $languages = $this->languageService->getPublicActive();
        return view('admin.faqs.categories.crud', compact('languages'));
    }

    /**
     * Store a FAQ category
     *
     * @param FaqStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FaqCategoryStoreRequest $request)
    {
        $this->faqCategoryService->create($request->validated());
        return redirect()->route('admin.faqs_categories.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.faqs_categories_created_successfully') ]
        ]);
    }

    /**
     * FAQs categories edit page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $languages = $this->languageService->getPublicActive();
        $faqCategory = $this->faqCategoryService->getById($id);
        return view('admin.faqs.categories.crud', compact('languages', 'faqCategory'));
    }

    /**
     * Update a FAQ category
     *
     * @param FaqStoreRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FaqCategoryStoreRequest $request, $id)
    {
        $this->faqCategoryService->update($id, $request->validated());
        return redirect()->route('admin.faqs_categories.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.faqs_categories_updated_successfully') ]
        ]);
    }

    /**
     * FAQs categories view page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id)
    {
        $languages = $this->languageService->getPublicActive();
        $faqCategory = $this->faqCategoryService->getById($id);
        return view('admin.faqs.categories.show', compact('languages', 'faqCategory'));
    }

    /**
     * Delete a FAQ category
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $success = $this->faqCategoryService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
