<?php

namespace App\Domains\Models\BaseAccount;

use App\Domains\Models\Hash;

class AccountPassword
{
    /**
     * @var string パスワード
     */
    private $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function value(): string
    {
        return $this->password;
    }

    public function toHash(): string
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }
}