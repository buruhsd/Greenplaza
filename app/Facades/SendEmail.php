<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SendEmailFacade extends Facade{
    protected static function getFacadeAccessor() { return 'SendEmail'; }
}