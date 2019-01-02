<?php

namespace App\Domains\Models\BaseAccount;

class AccountType
{
    private $type;

    public function __construct(int $type)
    {
        $this->type = $type;
    }

    public function value(): int
    {
        return $this->type;
    }
}