<?php

namespace App\Repositories;

use App\Models\Sahistod2;

class Sahistod2Repository extends BaseRepository
{
    public function __construct(Sahistod2 $model)
    {
        parent::__construct($model);
    }
}