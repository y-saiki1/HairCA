<?php

namespace Packages\Domain\Repositories\Accounts;

use Packages\Domain\Exceptions\NotExistsException;
use Packages\Domain\Exceptions\StylistProfileNotExistsException;

use Packages\Domain\Models\Account\Account;
use Packages\Domain\Models\Account\Stylist\Stylist;
use Packages\Domain\Models\Account\Guest\Guest;
use Packages\Domain\Models\JWT\JsonWebToken;
use Packages\Domain\Models\Hash;

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