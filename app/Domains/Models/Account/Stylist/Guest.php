<?php

namespace App\Domains\Models\Account\Stylist;

use App\Domains\Models\BaseAccount\AccountName;
use App\Domains\Models\Email\EmailAddress;
use App\Domains\Models\Hash;
use App\Domains\Models\Account\Stylist\Recommendation;

class Guest
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
     * @var Recommendation 推薦文
     */
    private $recommendation;

    /**
     * @param AccountName 送信者名
     * @param EmailAddress ゲストメールアドレス
     * @param Introduction 紹介文
     */
    public function __construct(
        AccountName $inviterName,
        EmailAddress $emailAddress, 
        Recommendation $recommendation
    ) {
        // BaseAccount properties
        $this->inviterName = $inviterName;
        $this->emailAddress = $emailAddress;

        // GuestAccount properties
        $this->token = new Hash(uniqid(rand(), true));
        $this->recommendation = $recommendation;
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