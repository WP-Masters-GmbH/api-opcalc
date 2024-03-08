<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class HomeFunctionsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Commands\PagesFunctions\HomeFunctions'; // Replace with the binding key used in the service provider
    }
}
