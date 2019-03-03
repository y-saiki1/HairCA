<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Exceptions\NotStylistException;

use App\Domains\Models\Hash;
use App\Domains\Models\Account\Stylist\StylistProfile\Recommendation;

use App\Domains\UseCase\Mailers\MailerCommand;
use App\Domains\Repositories\Accounts\Stylists\StylistCommand;
use App\Domains\Repositories\Accounts\Stylists\StylistQuery;
use App\Domains\Repositories\Accounts\AccountQuery;

class InviteStylistUseCase
{   
    /**
     * @var MailerCommand メール操作
     */
    private $emailCommand;

    /**
     * @var AccountQuery アカウント操作
     */
    private $accountQuery;

    /**
     * @var StylistCommand アカウント操作
     */
    private $stylistCommand;

    /**
     * @param AccountQuery メール操作
     * @param StylistCommand アカウント操作
     * @param StylistQuery アカウント取得
     */
    public function __construct(
        MailerCommand $emailCommand,
        AccountQuery $accountQuery,
        StylistCommand $stylistCommand
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

        $this->stylistCommand->saveGuest($guest);
        $this->emailCommand->sendInvitationMail($guest);

        return $guest->token();
    }
}