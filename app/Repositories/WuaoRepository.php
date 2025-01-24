<?php

namespace App\Repositories;

use App\Models\Wuao;

class WuaoRepository extends BaseRepository
{
    public function __construct(Wuao $model)
    {
        parent::__construct($model);
    }
}