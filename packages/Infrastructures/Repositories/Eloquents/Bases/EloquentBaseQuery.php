<?php

namespace Packages\Infrastructures\Repositories\Eloquents\Stylists;

use Packages\Domain\Repositories\Bases\BaseQuery;

use Packages\Infrastructures\Entities\Eloquents\EloquentBase;

class EloquentBaseQuery implements BaseQuery
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