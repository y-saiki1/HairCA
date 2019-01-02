<?php

namespace App\Domains\Models\Account\Stylist;

use App\Domains\Models\BaseAccount\Account;
use App\Domains\Models\BaseAccount\AccountId;
use App\Domains\Models\BaseAccount\AccountName;
use App\Domains\Models\BaseAccount\AccountPassword;
use App\Domains\Models\Account\Stylist\Guest;
use App\Domains\Models\Account\Stylist\Introduction;
use App\Domains\Models\Email\EmailAddress;

class Stylist extends Account
{
    const ACCOUNT_TYPE = 1; // Stylist

    /**
     * @return array Stylistの配列
     */
    public function toArray(): array
    {
        return [
        ];
    }

    public function inviteGuest(EmailAddress $emailAddress, Introduction $introduction): Guest
    {
        return new Guest(
            $this->name,
            $emailAddress, 
            $introduction
        );
    }
}