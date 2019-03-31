<?php

namespace App\Interactors\Accounts\Stylists;

use Packages\Domain\Exceptions\NotStylistException;

use Packages\Domain\Models\Hash;
use Packages\Domain\Models\Profile\StylistProfile\Recommendation;

use Packages\Domain\Repositories\Accounts\Stylists\StylistCommand;
use Packages\Domain\Repositories\Accounts\Stylists\StylistQuery;
use Packages\Domain\Repositories\Accounts\AccountQuery;

use Packages\Domain\UseCases\Mailers\MailerCommand;
use Packages\Domain\UseCases\Accounts\Stylists\InviteStylistUseCase;

class InviteStylistInteractor implements InviteStylistUseCase
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
     * @throws NotStylistException
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