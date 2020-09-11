<?php

namespace App\Http\Middleware;

use App\Models\Language;
use App\Services\CountryService;
use Closure;

class Locale
{
    private $defaultCountry = 'th';
    private $defaultLocale = 'th';
    // services
    private $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $code = $request->route('country') ?? $request->cookie('mistershield_country') ?? $this->defaultCountry;
        $locale = $request->route('locale') ?? $request->cookie('mistershield_locale') ?? $this->defaultLocale;

        // check if path is invalid but country and locale is missing
        if($returnedRoute = $this->invalidPath($request->route('country'))) {
            return redirect()->to($returnedRoute);
        }

        // root
        if (empty($request->route('country')) || empty($request->route('locale'))) {
            return redirect()->route('customer.home', [ 'country' => $code, 'locale' => $locale ]);
        }

        $currentRoute = $request->route()->getName();
        $country = $this->countryService->getByCode($code);


        if (isset($country) && in_array($country->status, ['enabled', 'draft'])) {
            $country->code = strtolower($country->code);
            // get language sorted by rankings
            $languages = moveToFirst($this->getRankedLanguages($country), 'code', $locale)->values();
            $language = $languages->firstWhere('code', $locale);
            // check locale if valid
            if (isset($language) && in_array($language->status_public, ['enabled', 'draft'])) {
                // set global data
                app('shared')->set('main', [
                    'country' => $country,
                    'language' => $language,
                    'languages' => $languages
                ]);
                app()->setLocale($language->code);
                return $next($request)
                    ->withCookie('mistershield_country', $country->code, 30)
                    ->withCookie('mistershield_locale', $language->code, 30);
            } else {
                // redirect to proper locale
                if (count($languages) > 0) {
                    return $this->redirect($currentRoute, $country->code, $languages[0]->code); // use top rank locale
                } else {
                    return $this->redirect($currentRoute, $this->defaultCountry, $this->defaultLocale);
                }
            }
        } else {
            return $this->redirect($currentRoute, $this->defaultCountry, $locale);
        }
    }

    private function redirect($routeName, $country, $locale)
    {
        return redirect()->route($routeName, ['country' => $country, 'locale' => $locale]);
    }

    private function getRankedLanguages($country)
    {
        return $country->public_active_languages->sort(function ($a, $b) {
            return $b->pivot->is_primary <=> $a->pivot->is_primary ?? $b->status <=> $a->status ?? $a->code <=> $b->code;
        });
    }

    // validate if path is correct but country and locale is not found
    private function invalidPath($code)
    {
        $validAddresses = [
            'about' => 'customer.about',
            'services' => 'customer.services',
            'pricing' => 'customer.pricing',
            'verify' => 'customer.verify',
            'completed-services' => 'customer.completed_services',
            'testimonials' => 'customer.testimonials',
            'faq' => 'customer.faq',
            'privacy-policy' => 'customer.privacy_policy',
            'terms-and-conditions' => 'customer.terms',
            'work-with-us' => 'customer.work_with_us',
            'contact' => 'customer.contact',
            'book-our-services' => 'customer.booking'
        ];

        $country = $this->countryService->getByCode($code);

        if(!$country) {
            $keys = array_keys($validAddresses);

            if(in_array($code, $keys)) {
                return route($validAddresses[$code], [$this->defaultCountry, $this->defaultLocale]);
            }
        }

        return false;
    }
}
