<?php

namespace App\Domains\Models\Profile;

class BirthDate extends \DateTime
{
    /**
     * @return DateInterval
     */
    public function diff($now = 'NOW', $absolute = false): \DateInterval
    {
        if (! ($now instanceOf \DateTime)) {
            $now = new \DateTime($now);
        }

        return parent::diff($now);
    }

    /**
     * @return int
     */
    public function age(): int
    { 
        return $this->diff()->format('%y');
    }

    /**
     * @return string
     */
    public function formatYMD(): string
    {
        return $this->format('Y-m-d');
    }
}