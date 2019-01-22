<?php

namespace App\Domains\Models;

class Hash
{
    /**
     * @var string ハッシュ
     */
    private $value;

    /**
     * @param string 文字列
     */
    public function __construct(string $string)
    {
        $this->value = password_hash($string, PASSWORD_BCRYPT);
    }

    /**
     * @return string ハッシュ
     */
    public function value(): string
    {
        return $this->value;
    }
}