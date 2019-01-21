<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Exceptions\NotExistsException;
use App\Domains\Models\Account\Account;
use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseQuery;
use App\Domains\UseCases\Accounts\AccountUseCaseQuery;

class AuthenticateInvitationUseCase
{
    /**
     * @var AccountUseCaseQuery アカウント操作UseCase
     */
    private $accountQuery;

    /**
     * @var StylistUseCaseQuery アカウント取得UseCase
     */
    private $stylistQuery;

    /**
     * @param AccountUseCaseQuery メール操作UseCase
     * @param StylistUseCaseQuery アカウント取得UseCase
     */
    public function __construct(
        AccountUseCaseQuery $accountQuery,
        StylistUseCaseQuery $stylistQuery
    ) {
        $this->accountQuery = $accountQuery;
        $this->stylistQuery = $stylistQuery;
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
        $guest = $this->StylistQuery->findGuestByEmailAddressAndToken($emailAddress, $invitationToken);

        try {
            $account = $this->accountQuery->findAccountByEmailAddress($guest->emailAddress());
        } catch(NotExistsException $e) {
            return $guest;
        }

        return $account;
    }
}