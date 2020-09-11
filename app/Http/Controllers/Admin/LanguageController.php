<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\LanguageService;
use App\Http\Requests\LanguageStoreRequest;

class LanguageController extends BaseController
{
    private $languageService;

    public function __construct(LanguageService $languageService)
    {
        parent::__construct();
        $this->languageService = $languageService;
        $this->middleware('permission:languages-list|languages-create|languages-edit|languages-delete', ['only' => ['index', 'store', 'show']]);
        $this->middleware('permission:languages-list', ['only' => ['index']]);
        $this->middleware('permission:languages-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:languages-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:languages-delete', ['only' => ['destroy']]);
        $this->middleware('permission:languages-view', ['only' => ['show']]);
    }
    
    public function index()
    {
        return view('admin.languages.index');
    }

    public function create()
    {
        return view('admin.languages.crud');
    }

    public function store(LanguageStoreRequest $request)
    {
        $this->languageService->create($request->validated());
        return redirect()->route('admin.languages.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.languages_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $language = $this->languageService->getById($id);
        return view('admin.languages.crud', compact('language'));
    }

    public function update(LanguageStoreRequest $request, $id)
    {
        $this->languageService->update($id, $request->validated());
        return redirect()->route('admin.languages.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.languages_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $language = $this->languageService->getById($id);
        return view('admin.languages.show', compact('language'));
    }

    public function destroy($id)
    {
        $success = $this->languageService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
