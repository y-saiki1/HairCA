<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Exceptions\NotStylistException;

use App\Domains\Models\Account\Stylist\StylistProfile;
use App\Domains\Models\Profile\BirthDate;
use App\Domains\Models\Profile\Sex;
use App\Domains\Repositories\Accounts\Stylists\StylistCommand;
use App\Domains\Repositories\Accounts\Stylists\StylistQuery;
use App\Domains\Repositories\Accounts\AccountQuery;

class CreateStylistProfileUseCase
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
     * @param string 自己紹介文
     * @param int 活動拠点ID
     * @param BirthDate 生年月日
     * @param Sex 性別
     * @return bool
     * @throws NotStylistException
     */
    public function __invoke(string $introduction, int $baseId, BirthDate $birthDate, Sex $sex): bool
    {
        $account = $this->accountQuery->myAccount();
        if ($account->isStylist()) throw new NotStylistException('Only Stylist Account can create Stylist Profile', NotStylistException::ERROR_CODE);

        return $this->stylistCommand->saveStylistProfile(
            $account->id(),
            $introduction,
            $baseId,
            $birthDate,
            $sex
        );
    }
}