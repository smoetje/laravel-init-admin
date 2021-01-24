<?php

namespace Smoetje\LaravelInitAdmin\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelInitAdmin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-init-admin';
    }
}
