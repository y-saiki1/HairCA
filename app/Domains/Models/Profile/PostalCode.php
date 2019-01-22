<?php

namespace App\Domains\Models\Profile;

class PostalCode
{
    /**
     * @var int 郵便番号
     */
    private $value;

    /**
     * @param int 郵便番号
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int 郵便番号
     */
    public function asInt(): int
    {
        return $this->value;
    }

    /**
     * @return string 郵便番号
     */
    public function asString(): string
    {
        return '〒' . (string)$this->value;
    }
}