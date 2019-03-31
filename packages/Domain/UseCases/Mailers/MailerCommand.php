<?php

namespace Packages\Domain\UseCases\Mailers;

use Packages\Domain\Models\Account\Guest\Guest;

interface MailerCommand
{
    /**
     * @param Guest ゲスト
     * @return void
     */
    public function sendInvitationMail(Guest $guest): void;
}