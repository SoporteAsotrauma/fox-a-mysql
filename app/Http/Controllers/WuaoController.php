<?php

namespace App\Http\Controllers;

use App\Services\WuaoService;

class WuaoController extends BaseController
{
    public function __construct(WuaoService $service)
    {
        parent::__construct($service);
    }
}