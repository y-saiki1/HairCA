<?php

namespace App\Domains\UseCases\Accounts;

use App\Domains\Models\BaseAccount\Account;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Stylist\Guest;
use App\Domains\Models\Hash;

interface AccountUseCaseQuery
{
    /**
     * @param EmailAddress メールアドレス
     * @param AccountPassword アカウントのパスワード
     * @return mixed string トークン | bool false ログイン失敗
     */
    public function login(string $emailAddress, string $password);

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
    public function findGuestByEmailAddressAndToken(string $emailAddress, string $invitationToken): ?Guest;

    /**
     * メールアドレスでアカウントを取得。なければNullを返す
     * @param string メールアドレス
     * @return Account AccountInterfaceを継承したクラス（Stylist or Member）
     */
    public function findAccountByEmailAddress(string $emailAddress): ?Account;
}