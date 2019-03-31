<?php

namespace Packages\Domain\Models\Profile;

use Packages\Domain\Exceptions\NotExistsException;

class Sex
{
    const MAN = 1;
    const WOMAN = 2;
    /**
     * @var int
     */
    private $value;

    /**
     * @param int
     */
    public function __construct(int $value)
    {
        if ($value === static::MAN) {
            $this->value = $value;
            return;
        }

        if ($value === static::WOMAN) {
            $this->value = $value;
            return;
        }

        throw new NotExistsException('User selected sex does not exists');
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