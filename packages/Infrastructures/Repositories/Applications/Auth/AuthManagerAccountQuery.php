<?php

namespace App\Infrastructures\Repositories\Applications\Auth;

use Illuminate\Auth\AuthManager;

use Packages\Domain\Exceptions\NotExistsException;

use Packages\Domain\Repositories\Accounts\AccountQuery;

use Packages\Domain\Models\Account\Account;
use Packages\Domain\Models\Account\Stylist\Stylist;
use Packages\Domain\Models\Account\Guest\Guest;
use Packages\Domain\Models\Hash;
use Packages\Domain\Models\JWT\JsonWebToken;

use App\Infrastructures\Entities\Eloquents\EloquentAccounts\EloquentAccount;
use App\Infrastructures\Entities\Eloquents\EloquentGuest;

class AuthManagerAccountQuery implements AccountQuery
{
    /**
     * @var AuthManager Laravelの認証クラス
     */
    private $authManager;

    /**
     * @var EloquentAccount
     */
    private $eloquentAccount;

    /**
     * @var EloqeuntGuest
     */
    private $eloquentGuest;

    /**
     * @param AuthManager Laravelの認証クラス
     * @param EloquentAccount
     * @param EloquentGuest
     */
    public function __construct(AuthManager $authManager, EloquentAccount $eloquentAccount, EloquentGuest $eloquentGuest)
    {
        $this->authManager = $authManager;
        $this->eloquentAccount = $eloquentAccount;
        $this->eloquentGuest = $eloquentGuest;
    }

    /**
     * @param string メールアドレス
     * @param string アカウントのパスワード
     * @return JsonWebToken JWTトークン
     */
    public function login(string $emailAddress, string $password): JsonWebToken
    {
        $token = $this->authManager
            ->guard('api')
            ->attempt([
                'email'    => $emailAddress,
                'password' => $password,
            ]);
            
        // tymon/jwt-authの例外をキャッチする必要あり。attemptではなく別のメソッドを探すべき
        if (! $token) throw new NotExistsException('Failed to login', NotExistsException::ERROR_CODE);

        return new JsonWebToken($token);
    }

    /**
     * JWT認証を通過した自分のアカウントを取得する
     * @return Account Stylist | Member
     */
    public function myAccount(): Account
    {
        return $this->authManager
            ->guard('api')
            ->user()
            ->toDomain();
    }

    /**
     * メールアドレスでアカウントを取得。
     * @param string メールアドレス
     * @return Account AccountInterfaceを継承したクラス（Stylist or Member）
     */
    public function findAccountByEmailAddress(string $emailAddress): Account
    {
        $account =  $this->eloquentAccount
            ->where('email', $emailAddress)
            ->first();

        if (! $account) throw new NotExistsException('An Account that have this Email is not exists', NotExistsException::ERROR_CODE);

        return $account->toDomain();
    }
}