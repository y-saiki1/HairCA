<?php

namespace App\Domains\UseCases\Accounts;

use App\Domains\Exceptions\NotExistsException;
use App\Domains\Exceptions\StylistProfileNotExistsException;

use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Stylist\Guest;
use App\Domains\Models\Hash;

interface AccountUseCaseQuery
{
    /**
     * @param EmailAddress メールアドレス
     * @param AccountPassword アカウントのパスワード
     * @return JsonWebToken JsonWebToken
     * @throws 
     */
    public function login(string $emailAddress, string $password): JsonWebToken;

    /**
     * アプリケーションにログインしたアカウントを取得する
     * @return Account
     * @throws StylistProfileNotExistsException アカウントがスタイリストで、プロフィールがない時に発生する。
     */
    public function myAccount(): Account;

    /**
     * メールアドレスと招待トークンでGuestユーザー（招待されたユーザー）を検索し、Guestを返す
     * @param EmailAddress $email
     * @param Hash 招待トークン
     * @return Guest ゲスト
     * @throws NotExistsException 指定メールアドレス・パスワードを持つゲストが存在しない時に発生する。
     */
    public function findGuestByEmailAddressAndToken(string $emailAddress, string $invitationToken): Guest;

    /**
     * メールアドレスでアカウントを取得。なければNullを返す
     * @param string メールアドレス
     * @return Account AccountInterfaceを継承したクラス（Stylist or Member）
     * @throws NotExistsException 指定メールアドレスを持つアカウントが存在しない時発生する。
     */
    public function findAccountByEmailAddress(string $emailAddress): Account;
}