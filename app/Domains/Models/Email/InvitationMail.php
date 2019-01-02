<?php

namespace App\Domains\Models\Email;

use App\Domains\Models\BaseAccount\AccountName;
use App\Domains\Models\Email\EmailAddress;
use App\Domains\Models\Hash;

class InvitationMail
{
    /**
     * @var AccountName 送信者名
     */
    private $accountName;

    /**
     * @var EmailAddress 受信者メールアドレス
     */
    private $to;

    /**
     * @var Hash 招待トークン
     */
    private $token;

    /**
     * @param AccountName 送信者名
     * @param EmailAddress 受信者メールアドレス
     */
    public function __construct(AccountName $accountName, EmailAddress $to)
    {
        $this->accountName = $accountName;
        $this->to = $to;
        $this->token = new Hash(uniqid(rand(), true));
    }

    /**
     * @return AccountName 送信者名
     */
    public function senderName(): AccountName
    {
        return $this->accountName;
    }

    /**
     * @return AccountName 送信者メールアドレス
     */
    public function from(): EmailAddress
    {
        return $this->from;
    }

    /**
     * @return AccountName 受信者メールアドレス
     */
    public function to(): EmailAddress
    {
        return $this->to;
    }

    public function token(): Hash
    {
        return $this->token;
    }
}