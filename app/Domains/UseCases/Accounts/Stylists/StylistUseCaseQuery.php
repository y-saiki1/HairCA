<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Exceptions\NotExistsException;

use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Guest\Guest;

interface StylistUseCaseQuery
{
    /**
     * メールアドレスと招待トークンでGuestユーザー（招待されたユーザー）を検索し、Guestを返す
     * @param string $email
     * @param string 招待トークン
     * @return Guest ゲスト
     * @throws NotExistsException 指定メールアドレス・パスワードを持つゲストが存在しない時に発生する。
     */
    public function findGuestByEmailAddressAndToken(string $emailAddress, string $invitationToken): Guest;

    /**
     * メールアドレスでGuestユーザー（招待されたユーザー）を検索し、Guestを返す
     * @param string $email
     * @return Guest ゲスト
     * @throws NotExistsException 指定メールアドレス・パスワードを持つゲストが存在しない時に発生する。
     */
    public function findGuestByEmailAddress(string $emailAddress): Guest;
}