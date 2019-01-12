<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\UseCases\Mailers\MailerUseCaseCommand;
use App\Domains\UseCases\Accounts\AccountUseCaseQuery;
use App\Domains\UseCases\Accounts\AccountUseCaseCommand;

use App\Domains\Models\Hash;
use App\Domains\Models\Account\Stylist\StylistProfile\Recommendation;

class InviteStylistUseCase
{
    /**
     * @var MailerUseCaseCommand メール操作UseCase
     */
    private $emailCommand;

    /**
     * @var AccountUseCaseQuery アカウント取得UseCase
     */
    private $accountQuery;

    /**
     * @var AccountUseCaseCommand アカウント操作UseCase
     */
    private $accountCommand;

    /**
     * @param MailerUseCaseCommand メール操作UseCase
     * @param AccountUseCaseQuery アカウント取得UseCase
     * @param AccountUseCaseCommand アカウント操作UseCase
     */
    public function __construct(
        MailerUseCaseCommand $emailCommand, 
        AccountUseCaseQuery $accountQuery, 
        AccountUseCaseCommand $accountCommand
    ) {
        $this->emailCommand = $emailCommand;
        $this->accountQuery = $accountQuery;
        $this->accountCommand = $accountCommand;
    }

    /**
     * ユーザーに招待メールを送る。トークン作成・保存・メール送信。
     * @param string メールアドレス
     * @param string 推薦文
     * @return InvitationToken 招待トークン
     */
    public function __invoke(string $emailAddress, string $recommendation): string
    {
        $stylist = $this->accountQuery->myAccount();
        $guest = $stylist->inviteGuest($emailAddress, $recommendation);

        $isSaved = $this->accountCommand->saveGuest($guest);
        $this->emailCommand->sendInvitationMail($guest);

        return $guest->token();
    }
}