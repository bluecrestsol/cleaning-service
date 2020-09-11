<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    protected $preService;

    public function __construct()
    {
        $this->preService = app()->make('App\Services\PreService');
    }

    public function _init()
    {
        $this->preService->forPublic();
    }

    public function callAction($method, $parameters)
    {
        unset($parameters['country']);
        unset($parameters['locale']);
        $this->_init();
        return parent::callAction($method, $parameters);
    }
}
