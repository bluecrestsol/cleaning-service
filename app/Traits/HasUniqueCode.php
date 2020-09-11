<?php

namespace App\Traits;

/**
 * Business logic for generating unique code
 */
Trait HasUniqueCode {

    /**
     * Generate unique code per country
     *
     * @param int $country
     * @return string
     */
    public function generateUniqueCodeOnCountry($country)
    {
        $country = $this->countryService->getById($country);
        do {
            $number = mt_rand(00000000, 99999999); 
            $code="{$this->prefixCode}{$number}{$country->code}";
        } while($this->isCodeExist($code));
        return $code;
    }

    /**
     * Check if code is already used by another record
     *
     * @param string $code
     * @return bool
     */
    public function isCodeExist($code)
    {
        $count = $this->model
            ->where('code', $code)
            ->count();
        return $count > 0;
    }
}