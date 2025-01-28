<?php

namespace App\Services;

use App\Repositories\SahistocRepository;

class SahistocService extends BaseService
{
    public function __construct(SahistocRepository $repository)
    {
        parent::__construct($repository);
    }
}