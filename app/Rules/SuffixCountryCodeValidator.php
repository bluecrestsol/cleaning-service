<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Validator for suffix country code
 */
class SuffixCountryCodeValidator implements Rule
{
    /**
     * @var CountryService $countryService
     */
    private $countryService;

    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
        $this->countryService = app()->make('App\Services\CountryService');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        preg_match('/[A-Z]{2}$/', $value, $matches);
        return count($matches) > 0 && !empty($this->countryService->getByCode($matches[0]));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('staff/validations.custom.suffix_country_code');
    }
}
