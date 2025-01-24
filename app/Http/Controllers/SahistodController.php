<?php

namespace App\Http\Controllers;

use App\Services\SahistodService;

class SahistodController extends BaseController
{
    public function __construct(SahistodService $service)
    {
        parent::__construct($service);
    }
}