<?php

namespace App\Infrastructures\Entities\Mails\Accounts;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string 送信者名
     */
    public $senderName;

    /**
     * @var string 招待トークン
     */
    public $token;

    /**
     * @var string 登録画面URL
     */
    public $createStylistUrl = 'https://';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $senderName, string $token)
    {
        $this->senderName = $senderName;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.inviteAccount');
    }
}
