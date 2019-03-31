<?php

namespace Packages\Domain\Models\Account\Member;

use Packages\Domain\Models\Account\Account;
use Packages\Domain\Models\Account\AccountTrait;

class Member implements Account
{
    use AccountTrait;

    const ACCOUNT_TYPE = 2;
    const ACCOUNT_TYPE_NAME = 'Member';
}