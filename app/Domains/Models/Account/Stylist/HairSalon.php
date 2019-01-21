<?php

namespace App\Domains\Models\Accounts\Stylist;

class HairSalon
{
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
     * @param string 美容室名
     * @param int 郵便番号
     * @param string 美容室の住所
     */
    public function __construct(
        string $hairSalonName,
        int $postalCode,
        string $homeAddress
    ) {
        $this->hairSalonName = $hairSalonName;
        $this->postalCode = $postalCode;
        $this->homeAddress = $homeAddress;
    }
}