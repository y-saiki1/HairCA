<?php

namespace App\Domains\UseCases\Accounts\Stylists;

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
     * @param AccountUseCaseQuery アカウント取得UseCase
     */
    public function __construct(AccountUseCaseCommand $accountCommand, AccountUseCaseQuery $accountQuery)
    {
        $this->accountCommand = $accountCommand;
        $this->accountQuery = $accountQuery;
    }

    /**
     * @param string アカウント名
     * @param string メールアドレス
     * @param string パスワード
     * @param string 招待トークン
     * @return mixed bool false | null ログイン失敗 | JsonWebToken jwt返却
     */
    public function __invoke(
        string $name,
        string $emailAddress,
        string $password,
        string $invitationToken
    ) {
        $guest = $this->accountQuery->findGuestByEmailAddressAndToken($emailAddress, $invitationToken);
        $isSaved = $this->accountCommand->saveStylist($name, $guest->emailAddress(), $password);
        if (! $isSaved) return false;

        return $this->accountQuery->login($guest->emailAddress(), $password);
    }
}