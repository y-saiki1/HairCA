<?php

namespace App\Domains\UseCases\Accounts;

use App\Domains\Models\BaseAccount\Account;
use App\Domains\Models\BaseAccount\AccountId;
use App\Domains\Models\Account\Stylist\Guest;

interface AccountUseCaseCommand
{
    /**
     * @param Guest
     * @return Account Stylist or Member
     */
    public function save(Guest $guest): Account;

    /**
     * @param AccountId アカウントID
     * @param Guest ゲスト
     * @return bool
     */
    public function saveGuest(AccountId $accountId, Guest $guest): bool;
}