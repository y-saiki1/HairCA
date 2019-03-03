<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Models\Account\Stylist\StylistProfile;
use App\Domains\Models\JWT\JsonWebToken;
use App\Domains\Repositories\Accounts\Stylists\StylistCommand;
use App\Domains\Repositories\Accounts\Stylists\StylistQuery;
use App\Domains\Repositories\Accounts\AccountQuery;

class CreateStylistUseCase
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
     * @param string アカウント名
     * @param string メールアドレス
     * @param string パスワード
     * @param string 招待トークン
     * @return JsonWebToken jwt返却
     */
    public function __invoke(string $name, string $emailAddress, string $password, string $invitationToken): JsonWebToken
    {
        $guest = $this->stylistQuery->findGuestByEmailAddressAndToken($emailAddress, $invitationToken);
        
        $stylist = $this->stylistCommand->saveStylist($name, $guest->emailAddress(), $password);
        $this->stylistCommand->saveRecommender($stylist->id(), $guest);

        return $this->accountQuery->login($stylist->emailAddress(), $password);
    }
}