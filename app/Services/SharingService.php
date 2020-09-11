<?php

namespace App\Services;
 
class SharingService
{
    private $shared = [];

    public function set($name, $value)
    {
        $this->shared[$name] = $value;
    }

    public function get($name, $default = null)
    {
        if (isset($this->shared[$name])) {
            return $this->shared[$name];
        }
        return $default;
    }
}