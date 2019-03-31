<?php

namespace Packages\Domain\Models\Account\Stylist;

class Recommender
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $recommendation;

    /**
     * @param int アカウントID
     * @param string アカウント名
     */
    public function __construct(int $id, string $name, string $recommendation)
    {
        $this->id = $id;
        $this->name = $name;
        $this->recommendation = $recommendation;
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

    /**
     * @return string 推薦文
     */
    public function recommendation(): string
    {
        return $this->recommendation;
    }
}