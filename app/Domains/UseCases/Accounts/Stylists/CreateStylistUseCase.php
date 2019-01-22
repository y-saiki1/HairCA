<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Models\Account\Stylist\StylistProfile;
use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseCommand;
use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseQuery;
use App\Domains\UseCases\Accounts\AccountUseCaseQuery;

class CreateStylistUseCase
{
    /**
     * @var AccountUseCaseQuery アカウント操作UseCase
     */
    private $accountQuery;

    /**
     * @var StylistUseCaseCommand アカウント操作UseCase
     */
    private $stylistCommand;

    /**
     * @var StylistUseCaseQuery アカウント取得UseCase
     */
    private $stylistQuery;

    /**
     * @param AccountUseCaseQuery メール操作UseCase
     * @param StylistUseCaseCommand アカウント操作UseCase
     * @param StylistUseCaseQuery アカウント取得UseCase
     */
    public function __construct(
        AccountUseCaseQuery $accountQuery,
        StylistUseCaseCommand $stylistCommand,
        StylistUseCaseQuery $stylistQuery
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
    public function __invoke(string $name, string $emailAddress, string $password, string $invitationToken) 
    {
        $guest = $this->stylistQuery->findGuestByEmailAddressAndToken($emailAddress, $invitationToken);
        
        $stylist = $this->stylistCommand->saveStylist($name, $guest->emailAddress(), $password);
        $this->stylistCommand->saveStylistProfile($stylist->id(), $guest);

        return $this->accountQuery->login($stylist->emailAddress(), $password);
    }
}