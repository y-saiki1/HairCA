<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Models\Account\Guest;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\BaseAccount\AccountName;
use App\Domains\Models\BaseAccount\AccountPassword;
use App\Domains\Models\Email\EmailAddress;

use App\Domains\UseCases\Accounts\AccountUseCaseCommand;
use App\Domains\UseCases\Accounts\AccountUseCaseQuery;

class CreateStylistUseCase
{
    /**
     * @var AccountUseCaseCommand アカウント操作UseCase
     */
    private $accountCommand;

    /**
     * @var AccountUseCaseQuery アカウント取得UseCase
     */
    private $accountQuery;

    /**
     * @param AccountUseCaseCommand アカウント操作UseCase
     */
    public function __construct(
        AccountUseCaseCommand $accountCommand,
        AccountUseCaseQuery $accountQuery
    ) {
        $this->accountCommand = $accountCommand;
        $this->accountQuery = $accountQuery;
    }

    /**
     * @param Guest ゲストアカウント
     */
    public function __invoke(Guest $guest)
    {
        $account = $this->accountCommand->save($guest);

        if (! $isSaved) return;
        
        $this->accountQuery->login(
            $account->emailAddress(),
            $account->password()
        );
        
    }
}