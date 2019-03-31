<?php

namespace App\Interactors\Accounts\Stylists;

use Packages\Domain\Models\JWT\JsonWebToken;

use Packages\Domain\Repositories\Accounts\AccountQuery;
use Packages\Domain\Repositories\Accounts\Stylists\StylistQuery;
use Packages\Domain\Repositories\Accounts\Stylists\StylistCommand;

use Packages\Domain\UseCases\Accounts\Stylists\CreateStylistUseCase;
use Packages\Domain\Models\Account\Account;

class CreateStylistInteractor implements CreateStylistUseCase
{
    /**
     * @var AccountQuery
     */
    private $accountQuery;

    /**
     * @var StylistCommand
     */
    private $stylistCommand;

    /**
     * @var StylistQuery
     */
    private $stylistQuery;

    /**
     * @param AccountQuery
     * @param StylistCommand 
     * @param StylistQuery
     */
    public function __construct(
        AccountQuery $accountQuery,
        StylistCommand $stylistCommand,
        StylistQuery $stylistQuery
    ) {
        $this->accountQuery = $accountQuery;
        $this->stylistCommand = $stylistCommand;
        $this->stylistQuery = $stylistQuery;
    }

    /**
     * @param string パスワード
     * @param string 招待トークン
     * @return JsonWebToken jwt返却
     */
    public function __invoke(Account $account, string $password, string $invitationToken): JsonWebToken
    {
        $guest = $this->stylistQuery->findGuestByEmailAddressAndToken($account->emailAddress(), $invitationToken);
        
        $stylist = $this->stylistCommand->saveStylist($account->name(), $guest->emailAddress(), $password);
        $this->stylistCommand->saveRecommender($stylist->id(), $guest);

        return $this->accountQuery->login($stylist->emailAddress(), $password);
    }
}