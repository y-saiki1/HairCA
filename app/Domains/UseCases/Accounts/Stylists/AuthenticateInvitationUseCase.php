<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Exceptions\NotExistsException;

use App\Domains\Models\BaseAccount\Account;

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
     * ゲストでもなければエラー(NotExistsException)を投げる
     * @param string メールアドレス
     * @param string 招待トークン
     * @param mixed Account | null
     */
    public function __invoke(string $emailAddress, string $invitationToken): Account
    {
        $guest = $this->accountUseCaseQuery->findGuestByEmailAddressAndToken($emailAddress, $invitationToken);
        if (! $guest) throw new NotExistsException('The Guest is not invited to have this Email and Token');

        $account = $this->accountUseCaseQuery->findAccountByEmailAddress($guest->emailAddress());
        return $account ? $account : $guest;
    }
}