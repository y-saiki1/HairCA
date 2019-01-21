<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Models\Account\Stylist\StylistProfile;
use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseCommand;
use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseQuery;
use App\Domains\UseCases\Accounts\AccountUseCaseQuery;

class CreateStylistProfileUseCase
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
     * @param string 自己紹介文
     * @param int 年齢
     * @param int 性別
     */
    public function __invoke(string $introduction, int $age, int $sex) 
    {
        $account = $this->accountQuery->myAccount();
        $guest = $this->stylistQuery->findGuestByEmailAddress($account->emailAddress());

        $stylistProfile = new StylistProfile(
            $guest->recommender(),
            $guest->recommendation(),
            $introduction,
            $age,
            $sex
        );

        return $this->stylistCommand->saveStylistProfile($myAccount->id(), $stylistProfile);
    }
}