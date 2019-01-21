<?php

namespace App\Domain\Models\Account\Stylist;

class Recommender
{
    /**
     * @param int アカウントID
     * @param string アカウント名
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int アカウントID
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string アカウント名
     */
    public function name(): string
    {
        return $this->name;
    }
}