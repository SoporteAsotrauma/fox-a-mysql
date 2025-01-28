<?php

namespace App\Repositories;

use App\Models\Sahistoc;

class SahistocRepository extends BaseRepository
{
    public function __construct(Sahistoc $model)
    {
        parent::__construct($model);
    }
}