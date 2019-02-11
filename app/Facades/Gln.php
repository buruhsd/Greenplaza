<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class GlnFacade extends Facade{
    protected static function getFacadeAccessor() { return 'Gln'; }
}