<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\BaseAccount\AccountType;
use App\Domains\Account\Stylist\Stylist;
use App\Domains\Models\Email\EmailAddress;
use App\Domains\Models\Hash;

use App\Domains\UseCases\Accounts\AccountUseCaseQuery;

class FindMyProfileUseCase
{
    private $accountUseCaseQuery;

    public function __construct(AccountUseCaseQuery $accountUseCaseQuery)
    {
        $this->accountUseCaseQuery = $accountUseCaseQuery;
    }

    public function __invoke(EmailAddress $emailAddress, Hash $invitationToken): Account
    {
        $guest = $this->accountUseCaseQuery->findGuestByEmailAndToken($emailAddress, $invitationToken);
        $member = $this->accountUseCaseQuery->findMemberByEmailAddress($guest->emailAddress());
        
        if ($member) return $member;
        return $guest;
    }
}