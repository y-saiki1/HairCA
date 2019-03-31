<?php

namespace Packages\Infrastructures\Mailers;

use Illuminate\Mail\Mailer;
use App\Jobs\SendEmailJob;

use Packages\Domain\Models\Account\Guest\Guest;

use Packages\Domain\UseCases\Mailers\MailerUseCaseCommand;
use Packages\Infrastructures\Entities\Mails\Accounts\InviteAccountMail;

class LaravelMailer implements MailerUseCaseCommand
{
    /**
     * @var Mailer LaravelMailer
     */
    private $mailer;

    /**
     * @param Mailer LaravelMailer
     * @return bool
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Guest ゲスト
     * @return void
     */
    public function sendInvitationMail(Guest $guest): void
    {
        $inviteAccountMail = new InviteAccountMail(
            $guest->recommender()->name(),
            $guest->emailAddress(),
            $guest->token()
        );

        SendEmailJob::dispatch($inviteAccountMail)->onQueue('invite_mail');
    }
}