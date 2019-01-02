<?php

namespace App\Domains\Models\Email;

class EmailAddress
{
    /**
     * @var string メールアドレス
     */
    private $address;

    /**
     * @param string メールアドレス
     */
    public function __construct(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string メールアドレス
     */
    public function value(): string
    {
        return $this->address;
    }
}