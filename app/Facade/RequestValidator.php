<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class RequestValidator extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'reqvalid';
    }
}
