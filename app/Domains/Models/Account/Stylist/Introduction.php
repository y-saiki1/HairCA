<?php

namespace App\Domains\Models\Account\Stylist;

class Introduction
{
    /**
     * @var string 紹介文
     */
    private $introduction;

    /**
     * @param string 紹介文
     */
    public function __construct(string $introduction)
    {
        $this->introduction = $introduction;
    }

    /**
     * @return string 紹介文
     */
    public function value(): string
    {
        return $this->introduction;
    }
}