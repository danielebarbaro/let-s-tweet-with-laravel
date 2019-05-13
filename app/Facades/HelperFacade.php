<?php

namespace App\Facades;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Facade as BaseFacade;

class HelperFacade extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return Helper::class;
    }
}
