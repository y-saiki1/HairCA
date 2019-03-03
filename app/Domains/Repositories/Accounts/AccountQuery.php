<?php

namespace App\Domains\Repositories\Accounts;

use App\Domains\Exceptions\NotExistsException;
use App\Domains\Exceptions\StylistProfileNotExistsException;

use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Guest\Guest;
use App\Domains\Models\JWT\JsonWebToken;
use App\Domains\Models\Hash;

interface AccountQuery
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
     * メールアドレスでアカウントを取得。なければNullを返す
     * @param string メールアドレス
     * @return Account AccountInterfaceを継承したクラス（Stylist or Member）
     * @throws NotExistsException 指定メールアドレスを持つアカウントが存在しない時発生する。
     */
    public function findAccountByEmailAddress(string $emailAddress): Account;
}