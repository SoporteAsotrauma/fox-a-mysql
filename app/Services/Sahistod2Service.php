<?php

namespace App\Services;

use App\Repositories\Sahistod2Repository;

class Sahistod2Service extends BaseService
{
    public function __construct(Sahistod2Repository $repository)
    {
        parent::__construct($repository);
    }
}