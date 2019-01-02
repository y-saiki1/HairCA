<?php

namespace App\Domains\UseCases\Accounts;

use App\Domains\Models\BaseAccount\Account;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Stylist\Guest;
use App\Domains\Models\Email\EmailAddress;
use App\Domains\Models\Hash;

interface AccountUseCaseQuery
{
    /**
     * アプリケーションにログインしたアカウントを取得する
     * @return Account
     */
    public function myAccount(): Account;

    /**
     * メールアドレスと招待トークンでGuestユーザー（招待されたユーザー）を検索し、Guestを返す
     * @param EmailAddress $email
     * @param Hash 招待トークン
     * @return Guest ゲスト
     */
    public function findGuestByEmailAndToken(EmailAddress $emailAddress, Hash $invitationToken): Guest;
}