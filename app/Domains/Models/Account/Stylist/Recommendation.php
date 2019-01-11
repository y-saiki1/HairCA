<?php

namespace App\Domains\Models\Account\Stylist;

class Recommendation
{
    /**
     * @var string 推薦文
     */
    private $recommendation;

    /**
     * @param string 推薦文
     */
    public function __construct(string $recommendation)
    {
        $this->recommendation = $recommendation;
    }

    /**
     * @return string 推薦文
     */
    public function value()
    {
        return $this->recommendation;
    }    
}