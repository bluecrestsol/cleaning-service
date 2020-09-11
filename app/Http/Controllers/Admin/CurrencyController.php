<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\CurrencyService;
use App\Http\Requests\CurrencyStoreRequest;

class CurrencyController extends BaseController
{
    private $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        parent::__construct();
        $this->currencyService = $currencyService;
        $this->middleware('permission:currencies-list', ['only' => ['index']]);
        $this->middleware('permission:currencies-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:currencies-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:currencies-delete', ['only' => ['destroy']]);
        $this->middleware('permission:currencies-view', ['only' => ['show']]);
    }
    
    public function index()
    {
        return view('admin.currencies.index');
    }

    public function create()
    {
        return view('admin.currencies.crud');
    }

    public function store(CurrencyStoreRequest $request)
    {
        $this->currencyService->create($request->validated());
        return redirect()->route('admin.currencies.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.currencies_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $currency = $this->currencyService->getById($id);
        return view('admin.currencies.crud', compact('currency'));
    }

    public function update(CurrencyStoreRequest $request, $id)
    {
        $this->currencyService->update($id, $request->validated());
        return redirect()->route('admin.currencies.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.currencies_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $currency = $this->currencyService->getById($id);
        return view('admin.currencies.show', compact('currency'));
    }

    public function destroy($id)
    {
        $success = $this->currencyService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
