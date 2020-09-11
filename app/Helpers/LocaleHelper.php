<?php
namespace App\Helpers;

use Illuminate\Support\Str;

class LocaleHelper
{
    public static function transColumn($column)
    {
        $locale = app()->getLocale();
        $fallback = config('app.fallback_locale');
        $query = "(IF (JSON_VALID(".columnize($column)."), 
                (IF(".static::JSON($column, "'$.{$locale}'")." IS NOT NULL, ".static::JSON($column, "'$.{$locale}'").",
                    (IF(".static::JSON($column, "'$.{$fallback}'")." IS NOT NULL, ".static::JSON($column, "'$.{$fallback}'").", NULL))
                )),
            NULL))";
        return preg_replace('/\s+/', ' ', $query);
    }

    public static function magicTrans($column)
    {
        $field = null;
        if (Str::startsWith($column, '$$')) {
            $field = static::transColumn(str_replace('$$', '', $column));
        } else {
            $field = columnize($column);
        }
        return $field;
    }

    public static function JSON($column, $path) {
        return "JSON_UNQUOTE(JSON_EXTRACT(".columnize($column).", {$path}))";
    }

    public static function isJsonNotNull($column, $path) {
        return "JSON_VALID({$column}) AND
            ".static::JSON($column, $path)." IS NOT NULL AND
            ".static::JSON($column, $path)." != ''";
    }
}