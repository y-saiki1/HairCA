<?php

namespace App\Domains\Models\Account\Stylist;

use App\Domains\Models\Account\Stylist\Recommender;

class StylistProfile
{
    /**
     * @var Recommender 推薦者
     */
    private $recommender;

    /**
     * @var string 推薦文
     */
    private $recommendation;

    /**
     * @var string 自己紹介文
     */
    private $introduction;

    /**
     * @var int 年齢
     */
    private $age;
    
    /**
     * @var int 性別
     */
    private $sex;

    /**
     * @param Recommender 推薦者
     * @param string 推薦文
     * @param string 自己紹介文
     * @param int 年齢
     * @param int 性別
     */
    public function __construct(
        Recommender $recommender,
        string $recommendation,
        string $introduction,
        int $age,
        int $sex
    ) {
        // StylistProfile
        $this->recommender = $recommender;
        $this->introduction = $introduction;
        $this->recommendation = $recommendation;
        $this->age = $age;
        $this->sex = $sex;
    }

    /**
     * @return Recommender 推薦者
     */
    public function recommender(): Recommender
    {
        return $this->recommender;
    }

    /**
     * @return string 推薦文
     */
    public function recommendation(): string
    {
        return $this->recommendation;
    }
}