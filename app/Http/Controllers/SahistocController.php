<?php

namespace App\Http\Controllers;

use App\Services\SahistocService;

class SahistocController extends BaseController
{
    public function __construct(SahistocService $service)
    {
        parent::__construct($service);
    }
}