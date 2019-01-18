<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Exceptions\NotExistsException;

use App\Domains\Models\Account\Account;

use App\Domains\UseCases\Accounts\AccountUseCaseQuery;

class AuthenticateInvitationUseCase
{
    private $accountUseCaseQuery;

    public function __construct(AccountUseCaseQuery $accountUseCaseQuery)
    {
        $this->accountUseCaseQuery = $accountUseCaseQuery;
    }

    /**
     * 招待認証機能。
     * ゲスト招待されており、すでに会員だったら自分のAccountを返す。
     * 会員でなければゲストを返す。
     * @param string メールアドレス
     * @param string 招待トークン
     * @param Account Guest | Stylist | Member
     */
    public function __invoke(string $emailAddress, string $invitationToken): Account
    {
        $guest = $this->accountUseCaseQuery->findGuestByEmailAddressAndToken($emailAddress, $invitationToken);

        try {
            $account = $this->accountUseCaseQuery->findAccountByEmailAddress($guest->emailAddress());
        } catch(NotExistsException $e) {
            return $guest;
        }

        return $account;
    }
}