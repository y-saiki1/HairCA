<?php

namespace Packages\Domain\Models\HairStyleModel;

class HairStyleModel
{
    /**
     * @param
     */
    public function __construct(
        $faceType,
        $hairType,
        $hairBoldType,
        $hairAmountType,
        $age,
        $sex
    ) {
        $this->faceType = $faceType;
        $this->hairType = $hairType;
        $this->hairBoldType = $hairBoldType;
        $this->hairAmountType = $hairAmountType;
        $this->age = $age;
        $this->sex = $sex;
    }
}