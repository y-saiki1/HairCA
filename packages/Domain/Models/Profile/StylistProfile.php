<?php

namespace Packages\Domain\Models\Profile;

use Packages\Domain\Models\Profile\Sex;
use Packages\Domain\Models\Profile\BirthDate;
use Packages\Domain\Models\Account\Stylist\Stylist;

class StylistProfile
{
    private $id;
    private $stylist;
    private $introduction;
    private $birthDate;
    private $sex;

    public function __construct(
        Stylist $stylist,
        string $introduction,
        BirthDate $birthDate,
        Sex $sex,
        int $id = null
    ) {
        $this->id = $id;
        $this->stylist = $stylist;
        $this->introduction = $introduction;
        $this->birthDate = $birthDate;
        $this->sex = $sex;
    }

    public function stylistId(): int
    {
        return $this->stylist->id();
    }

    public function introduction(): string
    {
        return $this->introduction;
    }

    public function birthDate(): string
    {
        return $this->birthDate->formatYMD();
    }

    public function sexAsInt(): int
    {
        return $this->sex->asInt();
    }
}