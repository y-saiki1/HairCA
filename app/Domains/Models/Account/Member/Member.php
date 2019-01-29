<?php

namespace App\Domains\Models\Account\Member;

use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\AccountTrait;

class Member implements Account
{
    use AccountTrait;

    const ACCOUNT_TYPE = 2;
    const ACCOUNT_TYPE_NAME = 'Member';
}