<?php

namespace App\Domains\Models\Profile;

class Sex
{
    /**
     * @var int
     */
    private $value;

    /**
     * @param int
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function asInt(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        if ($this->value === 1) return '男性';
        if ($this->value === 2) return '女性';
    }
}