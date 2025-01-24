<?php

namespace App\Services;

use App\Repositories\SahistodRepository;

class SahistodService extends BaseService
{
    public function __construct(SahistodRepository $repository)
    {
        parent::__construct($repository);
    }
}