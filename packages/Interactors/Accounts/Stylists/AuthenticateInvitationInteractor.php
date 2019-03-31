<?php

namespace App\Interactors\Accounts\Stylists;

use Packages\Domain\Models\Account\Account;
use Packages\Domain\Exceptions\NotExistsException;
use Packages\Domain\Repositories\Accounts\AccountQuery;
use Packages\Domain\Repositories\Accounts\Stylists\StylistQuery;
use Packages\Domain\UseCases\Accounts\Stylists\AuthenticateInvitationUseCase;

class AuthenticateInvitationInteractor implements AuthenticateInvitationUseCase
{
    /**
     * @var AccountQuery
     */
    private $accountQuery;

    /**
     * @var StylistQuery
     */
    private $stylistQuery;

    /**
     * @param AccountQuery
     * @param StylistQuery 
     */
    public function __construct(
        AccountQuery $accountQuery,
        StylistQuery $stylistQuery
    ) {
        $this->accountQuery = $accountQuery;
        $this->stylistQuery = $stylistQuery;
    }

    /**
     * 招待認証機能。
     * ゲスト招待されており、すでに会員だったら自分のAccount(Member or Stylist)を返す。
     * 会員でなければゲストを返す。
     * @param string メールアドレス
     * @param string 招待トークン
     * @param Account Guest | Stylist | Member
     */
    public function __invoke(string $emailAddress, string $invitationToken): Account
    {
        $guest = $this->stylistQuery->findGuestByEmailAddressAndToken($emailAddress, $invitationToken);

        try {
            $account = $this->accountQuery->findAccountByEmailAddress($guest->emailAddress());
        } catch(NotExistsException $e) {
            return $guest;
        }

        return $account;
    }
}