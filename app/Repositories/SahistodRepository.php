<?php

namespace App\Repositories;

use App\Models\Sahistod;

class SahistodRepository extends BaseRepository
{
    public function __construct(Sahistod $model)
    {
        parent::__construct($model);
    }
}