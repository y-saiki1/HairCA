<?php

namespace App\Domains\Models\Account\Stylist;

class StylistProfile
{
    /**
     * @var string 自己紹介文
     */
    private $introduction;

    /**
     * @var string 推薦文
     */
    private $recommendation;

    /**
     * @var int 年齢
     */
    private $age;
    
    /**
     * @var int 性別
     */
    private $sex;

    /**
     * @var string 美容室名
     */
    private $hairSalonName;

    /**
     * @var int 郵便番号
     */
    private $postalCode;

    /**
     * @var string 美容室の住所
     */
    private $homeAddress;

    /**
     * @param string 自己紹介文
     * @param string 推薦文
     * @param string 美容室名
     * @param int 年齢
     * @param int 性別
     * @param int 郵便番号
     * @param string 美容室の住所
     */
    public function __construct(
        string $introduction, 
        string $recommendation,
        int $age,
        int $sex,
        string $hairSalonName,
        int $postalCode,
        string $homeAddress
    ) {
        // StylistProfile
        $this->introduction = $introduction;
        $this->recommendation = $recommendation;
        $this->hairSalonName = $hairSalonName;

        // BaseProfile
        $this->age = $age;
        $this->sex = $sex;
        $this->postalCode = $postalCode;
        $this->homeAddress = $homeAddress;
    }
}