<?php

namespace App\Interactors\Accounts\StylistProfiles;

use Packages\Domain\Exceptions\NotStylistException;

use Packages\Domain\Models\Profile\BirthDate;
use Packages\Domain\Models\Profile\Sex;

use Packages\Domain\Repositories\Accounts\Stylists\StylistCommand;
use Packages\Domain\Repositories\Accounts\Stylists\StylistQuery;
use Packages\Domain\Repositories\Accounts\AccountQuery;

use Packages\Domain\UseCases\Accounts\StylistProfiles\CreateStylistProfileUseCase;

class CreateStylistProfileInteractor implements CreateStylistProfileUseCase
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
        $stylist = $this->accountQuery->myAccount();
        if (! $stylist->isStylist()) throw new NotStylistException('Only Stylist Account can create Stylist Profile', NotStylistException::ERROR_CODE);

        $stylistProfile = $stylist->createProfile(
            $introduction,
            $birthDate,
            $sex
        ); 

        return $this->stylistCommand->saveStylistProfile($baseId, $stylistProfile);
    }
}