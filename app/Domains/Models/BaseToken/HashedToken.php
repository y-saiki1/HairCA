<?php

namespace App\Domains\Models\BaseToken;

class HashedToken
{
    private $token;

    public function __construct(string $token)
    {
        $this->token = password_hash($token, PASSWORD_BCRYPT);
    }

    public function value(): string
    {
        return $this->token;
    }
}