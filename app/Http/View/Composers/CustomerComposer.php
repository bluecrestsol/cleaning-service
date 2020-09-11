<?php

namespace App\Http\View\Composers;

use App\Services\CountryService;
use App\Traits\HasBlacklist;
use Illuminate\View\View;
use Illuminate\Support\Arr;

class CustomerComposer
{
    use HasBlacklist;
    protected $blacklist = [
        'customer.*.partials.*'
    ];
    protected $countryService;

    public function __construct(CountryService $countryService)
	{
        $this->countryService = $countryService;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $allow = $this->check($view->getName());
        if ($allow) {
            $main = app('shared')->get('main');
            app('shared')->set('main', Arr::except($main, ['languages']));
            $main['countries'] = moveToFirst($this->countryService->getActive()->sort(function ($a, $b) {
                return $b->status <=> $a->status ?: $a->code <=> $b->code;
            }), 'code', $main['country']->code)->values()->map->only(['id','code','name']);
            $main['languages'] = $main['languages']->map->only(['id','code','name','english_name','status_public']);
            $view->with(['main' => $main]);
        }
    }
}
