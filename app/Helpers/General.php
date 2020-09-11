<?php
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Carbon\Carbon;

if (!function_exists('formatTelNumber'))
{
    function formatTelNumber($code, $number)
    {
        $str = '';
        if (!empty($number) && !empty($code)) {
            $str = '+'.$code.$number;
        }
        return $str;
    }
}

if (!function_exists('toSelect2Format'))
{
    function toSelect2Format($options, $keys = array('id', 'text'))
    {
        return $options->map(function($option) use ($keys) {
            return [
                'id' => $option[$keys[0]],
                'text' => $option[$keys[1]]
            ];
        });
    }
}

if (!function_exists('columnize'))
{
    function columnize($column)
    {
        return '`'.str_replace('.', '`.`', $column).'`';
    }
}

if (!function_exists('toPathOS'))
{
    function toPathOS($str)
    {
        return str_replace(array('/','\\'), DIRECTORY_SEPARATOR, $str);
    }
}

if (!function_exists('moveToFirst'))
{
    function moveToFirst($collection, $key, $value)
    {
        $rejected = null;
        $collection = $collection->reject(function ($item) use (&$rejected, $key, $value) {
            if(strtolower($item[$key]) === strtolower($value)) {
                $rejected = $item;
                return true;
            }
            return false;
        });
        if (!empty($rejected))
            $collection->prepend($rejected);
        return $collection;
    }
}

if (!function_exists('lroute')) {
    function lroute($path, $params = []) {
        $country = request()->country;
        $locale = request()->locale;
        $params = Arr::prepend(Arr::prepend($params, $locale), $country);
        return route($path, $params);
    }
}

if (!function_exists('getOnlyNumbers')) {
    function getOnlyNumbers($string) {
        return preg_replace('/[^0-9]/', '', $string);
    }
}

if (!function_exists('modified_chunk')) {
    function modified_chunk($arr, $size) {
        $len = $arr->count(); // total
        $rows = $len > $size ? floor($len/$size) : 1; // number of rows
        $extra = $len - $size; // number of extra columns

        // get balanced chunk
        $items = collect([]);
        for ($ctr=0; $ctr < $size; $ctr++) {
            $end = $rows + ($extra > 0 ? 1 : 0);
            $items->push($arr->splice(0, $end));
            $extra--;
        }
        return $items;
    }
}

if (!function_exists('implodeNotNull')) {
    function implodeNotNull($needle, $arr) {
       return implode($needle, array_filter($arr, function($value) { return !empty($value); }));
    }
}

if(!function_exists('withUnit')) {
    function withUnit($value, $unit) {
        return $value . (isset($unit) ? " ({$unit})" : '');
    }
}

if(!function_exists('arrayKeyHasValue')) {
    function arrayKeyHasValue($arr, $key, $value) {
        return in_array($value, Arr::pluck($arr, $key));
    }
}

if(!function_exists('getOr')) {
    function getOr($value, $default = null) {
        $value = $value ?? null;
        return !empty($value) ? $value : $default;
    }
}

if(!function_exists('getTimeZoneByCountry')) {
    /**
     * Get timezone of a country code
     *
     * @param string $code
     * @return array
     */
    function getTimeZoneByCountry($code) {
        return DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $code);
    }
}

if(!function_exists('toUtc')) {
    /**
     * Convert datetime to UTC
     *
     * @param string $value
     * @param string $timezone
     * @return Carbon
     */
    function toUtc($value, $timezone = null) {
        return !empty($value) ? Carbon::parse($value, $timezone)->setTimezone('UTC') : $value;
    }
}

if(!function_exists('decimal')) {
    /**
     * Convert value to decimal
     *
     * @param string $value
     */
    function decimal($value) {
        return preg_replace('/\.0+$/', '', $value);
    }
}

if(!function_exists('clean')) {
    /**
     * Strip tags and limit string
     * @param string $str
     * @param int $length
     */
    function clean($str, $length) {
        return Str::limit(trim(preg_replace('/\s\s+/', ' ', strip_tags(preg_replace('/<br(\s+)?\/?>/i', " ", $str)), $length)));
    }
}

if(!function_exists('slug')) {
    /**
     * Get slug of a string
     * @param string $str
     */
    function slug($str) {
        return Str::slug($str);
    }
}

if(!function_exists('localizedSlug')) {
    /**
     * Get slug of a string
     * @param string $str
     */
    function localizedSlug($str) {
        $str = explode(' ', strtolower($str));

        return implode('-', $str);
    }
}

if(!function_exists('currencyFormatDecimal')) {
    /**
     * Format decimal into money format
     * @param string $str
     */
    function currencyFormatDecimal($decimal) {
        $count = explode('.', $decimal);

        return count($count) > 1 ? number_format($decimal, 2) : number_format($decimal, 0);
    }
}

if(!function_exists('isAdminRoute')) {
    /**
     * Check if route is for admin
     * 
     * @return bool
     */
    function isAdminRoute() {
        return request()->route()->middleware()[0] === 'admin';
    }
}

