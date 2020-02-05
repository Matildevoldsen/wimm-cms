<?php

namespace WimmCMS\core\Facades;

use Illuminate\Support\Facades\Facade;

class core extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'core';
    }
}
