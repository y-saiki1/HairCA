<?php

namespace App\Infrastructures\Repositories\Eloquents\Stylists;

use App\Domains\UseCases\Bases\BaseQueryUseCase;

use App\Infrastructures\Entities\Eloquents\EloquentBase;

class EloquentBaseQueryRepository implements BaseQueryUseCase
{
    /**
     * @var EloquentBase
     */
    private $eloquentBase;

    /**
     * @param EloquentBase
     */
    public function __construct(EloquentBase $eloquentBase)
    {
        $this->eloquentBase = $eloquentBase;
    }

    public function findAll()
    {
    }
}