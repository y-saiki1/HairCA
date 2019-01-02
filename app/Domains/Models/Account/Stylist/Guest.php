<?php

namespace App\Domains\Models\Account\Stylist;

use App\Domains\Models\BaseAccount\Account;
use App\Domains\Models\BaseAccount\AccountName;
use App\Domains\Models\Email\EmailAddress;
use App\Domains\Models\Hash;

class Guest extends Account
{
    /**
     * @var AccountName 招待者名
     */
    private $inviterName;

    /**
     * @var Hash 招待トークン
     */
    private $token;

    /**
     * @var Introduction 紹介文
     */
    private $introduction;

    /**
     * @param AccountName 送信者名
     * @param EmailAddress ゲストメールアドレス
     * @param Introduction 紹介文
     */
    public function __construct(
        AccountName $inviterName,
        EmailAddress $emailAddress, 
        Introduction $introduction
    ) {
        // BaseAccount properties
        $this->inviterName = $inviterName;
        $this->emailAddress = $emailAddress;

        // GuestAccount properties
        $this->token = new Hash(uniqid(rand(), true));
        $this->introduction = $introduction;
    }

    /**
     * @return array Guestの配列
     */
    public function toArray(): array
    {
        return [
            'inviterName'  => $this->inviterName,
            'emailAddress' => $this->emailAddress
        ];
    }

    /**
     * @return AccountName 招待者
     */
    public function inviterName(): AccountName
    {
        return $this->inviterName;
    }

    /**
     * @return Hash 招待トークン
     */
    public function token(): Hash
    {
        return $this->token;
    }

    /**
     * @return Introduction 紹介文
     */
    public function introduction(): Introduction
    {
        return $this->introduction;
    }
}