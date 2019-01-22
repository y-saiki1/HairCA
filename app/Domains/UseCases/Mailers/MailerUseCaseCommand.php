<?php

namespace App\Domains\UseCases\Mailers;

use App\Domains\Models\Account\Guest\Guest;

interface MailerUseCaseCommand
{
    /**
     * @param Guest ゲスト
     * @return void
     */
    public function sendInvitationMail(Guest $guest): void;
}