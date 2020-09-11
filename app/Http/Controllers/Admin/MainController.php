<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;

class MainController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        if (auth('staff')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login.index');
    }

    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    public function changeLanguage($language)
    {
        session()->put('mistershield_staff_language', $language);
        app()->setLocale($language);
        return redirect()->back();
    }
}
