<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Exceptions\NotStylistException;

use App\Domains\Models\Account\Stylist\StylistProfile;
use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseCommand;
use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseQuery;
use App\Domains\UseCases\Accounts\AccountUseCaseQuery;

class UpdateStylistProfileUseCase
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
     * @param string 都道府県
     * @throws NotStylistException
     */
    // public function __invoke(string $introduction, \DateTime $birthDate, int $sex, string $prefecture): bool
    public function __invoke(StylistProfile $stylistProfile, HairSalon $hairSalon): bool
    {
        $account = $this->accountQuery->myAccount();
        if ($account->isStylist()) throw new NotStylistException('Only Stylist Account can create Stylist Profile', NotStylistException::ERROR_CODE);

        return $this->stylistCommand->updateStylistProfile(
            $account->id(),
            $introduction,
            $age,
            $sex,
            $prefecture
        );
    }
}