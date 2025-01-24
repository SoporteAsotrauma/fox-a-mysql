<?php

namespace App\Http\Controllers;

use App\Services\Sahistod2Service;

class Sahistod2Controller extends BaseController
{
    public function __construct(Sahistod2Service $service)
    {
        parent::__construct($service);
    }
}