<?php

namespace App\Domains\Models\Token;

class TimeToLive
{
    /**
     * @var int トークン有効期限
     */
    private $ttl;

    /**
     * @param int トークン有効期限
     */
    public function __construct(int $ttl)
    {
        $this->ttl = $ttl;
    }

    public function value(): int
    {
        return $this->ttl;
    }

    public function mult(self $ttl)
    {
        return new static($this->ttl->value() * $ttl->value());
    }
}