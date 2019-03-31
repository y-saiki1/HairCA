<?php

namespace Packages\Domain\Models\HairSalon;

class HairSalon
{
    /**
     * @var string 美容室名
     */
    private $hairSalonName;

    /**
     * @var HomeAddress 美容室の住所
     */
    private $homeAddress;

    /**
     * @param string 美容室名
     * @param string 美容室の住所
     */
    public function __construct(
        string $hairSalonName,
        HomeAddress $homeAddress
    ) {
        $this->hairSalonName = $hairSalonName;
        $this->postalCode = $postalCode;
        $this->homeAddress = $homeAddress;
    }
}