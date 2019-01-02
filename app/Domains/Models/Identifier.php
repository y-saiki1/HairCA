<?php

namespace App\Domains\Models;

abstract class Identifier
{
    /**
     * @var int NOT_EXIST_ID 
     */
    const NOT_EXIST_ID = 0;

    /**
     * @var int $id 
     */
    protected $id;

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->id;
    }

    /**
     * @param Identifier $id
     * @return bool
     */
    public static function of(int $id = self::NOT_EXIST_ID)
    {
        return new static($id);
    }
}
