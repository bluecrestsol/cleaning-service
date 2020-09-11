<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Services\LanguageService;
use App\Traits\HasBlacklist;

class StaffComposer
{
    use HasBlacklist;
    protected $blacklist = [
        'admin.login.*',
        'admin.partials.*',
        'admin.*.partials.*'
    ];

    public function __construct(LanguageService $languageService)
	{
        $this->languageService = $languageService;
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
            $admin =  app('shared')->get('admin');
            $permissions = $admin->getAllPermissions()->pluck('name');
            $languages = $this->languageService->getStaffEnabled();
            $view->with([
                'admin' => $admin,
                'adminPermissions' => $permissions,
                'main' => [
                    'companies' => collect([$admin->active_company]),
                    'countries' => collect([$admin->active_country]),
                    'languages' => $languages
                ]
            ]);
        }
    }
}