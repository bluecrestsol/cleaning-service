<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $preService;

    public function __construct()
    {
        $this->preService = app()->make('App\Services\PreService');
    }

    public function _init()
    {
        $this->preService->forAdmin();
    }

    public function callAction($method, $parameters)
    {
        $this->_init();
        return parent::callAction($method, $parameters);
    }
}
