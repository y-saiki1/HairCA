<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Exceptions\NotStylistException;

use App\Domains\Models\Hash;
use App\Domains\Models\Account\Stylist\StylistProfile\Recommendation;

use App\Domains\UseCases\Mailers\MailerUseCaseCommand;
use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseCommand;
use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseQuery;
use App\Domains\UseCases\Accounts\AccountUseCaseQuery;

class InviteStylistUseCase extends StylistUseCase
{   
    /**
     * @var MailerUseCaseCommand メール操作UseCase
     */
    private $emailCommand;

    /**
     * @var AccountUseCaseQuery アカウント操作UseCase
     */
    private $accountQuery;

    /**
     * @var StylistUseCaseCommand アカウント操作UseCase
     */
    private $stylistCommand;

    /**
     * @param AccountUseCaseQuery メール操作UseCase
     * @param StylistUseCaseCommand アカウント操作UseCase
     * @param StylistUseCaseQuery アカウント取得UseCase
     */
    public function __construct(
        MailerUseCaseCommand $emailCommand,
        AccountUseCaseQuery $accountQuery,
        StylistUseCaseCommand $stylistCommand
    ) {
        $this->emailCommand = $emailCommand;
        $this->accountQuery = $accountQuery;
        $this->stylistCommand = $stylistCommand;
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
        if (! $stylist->isStylist()) throw new NotStylistException('Only Stylist Account can send a invitation mail', NotStylistException::ERROR_CODE);

        $guest = $stylist->inviteGuest($emailAddress, $recommendation);

        $isSaved = $this->stylistCommand->saveGuest($guest);
        $this->emailCommand->sendInvitationMail($guest);

        return $guest->token();
    }
}