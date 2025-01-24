<?php

namespace App\Services;

use App\Repositories\WuaoRepository;

class WuaoService extends BaseService
{
    public function __construct(WuaoRepository $repository)
    {
        parent::__construct($repository);
    }
}