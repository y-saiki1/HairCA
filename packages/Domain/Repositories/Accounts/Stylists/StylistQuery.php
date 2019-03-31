<?php

namespace Packages\Domain\Repositories\Accounts\Stylists;

use Packages\Domain\Exceptions\NotExistsException;

use Packages\Domain\Models\Account\Account;
use Packages\Domain\Models\Account\Stylist\Stylist;
use Packages\Domain\Models\Account\Guest\Guest;

interface StylistQuery
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