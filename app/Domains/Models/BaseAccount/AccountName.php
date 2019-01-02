<?php

namespace App\Domains\Models\BaseAccount;

class AccountName
{
    /**
     * @var string $accountName
     */
    private $accountName;

    /**
     * @param string $accountName
     */
    public function __construct(string $accountName)
    {
        $this->accountName = $accountName;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->accountName;
    }
}