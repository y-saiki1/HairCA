<?php

namespace App\Infrastructures\Repositories\Applications\Auth;

use Illuminate\Auth\AuthManager;

use App\Domains\UseCases\Accounts\AccountUseCaseQuery;

use App\Domains\Models\BaseAccount\Account;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Stylist\Guest;
use App\Domains\Models\Hash;
use App\Domains\Models\JWT\JsonWebToken;

use App\Infrastructures\Entities\Eloquents\EloquentUser;
use App\Infrastructures\Entities\Eloquents\EloquentGuest;

class AuthManagerAccountQueryRepository implements AccountUseCaseQuery
{
    /**
     * @var AuthManager Laravelの認証クラス
     */
    private $authManager;

    /**
     * @var EloqeuntUser Eloqeuntユーザー
     */
    private $eloquentUser;

    /**
     * @var EloqeuntGuest Eloqeuntゲスト
     */
    private $eloquentGuest;

    /**
     * @param AuthManager Laravelの認証クラス
     * @param EloquentUser eloquentUser
     * @param EloquentGuest eloquentGuest
     */
    public function __construct(AuthManager $authManager, EloquentUser $eloquentUser, EloquentGuest $eloquentGuest)
    {
        $this->authManager = $authManager;
        $this->eloquentUser = $eloquentUser;
        $this->eloquentGuest = $eloquentGuest;
    }

    /**
     * @param string メールアドレス
     * @param string アカウントのパスワード
     * @return mixed string JWTトークン | null ログイン失敗
     */
    public function login(string $emailAddress, string $password)
    {
        $token = $this->authManager
            ->guard('api')
            ->attempt([
                'email'    => $emailAddress,
                'password' => $password,
            ]);

        return $token ? new JsonWebToken($token) : null;
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
     * メールアドレスと招待トークンでGuestユーザー（招待されたユーザー）を検索し、Guestを返す
     * @param string $email
     * @param string 招待トークン
     * @return Guest ゲスト
     */
    public function findGuestByEmailAddressAndToken(string $emailAddress, string $invitationToken): ?Guest
    {
        $guest = $this->eloquentGuest
            ->where('email', $emailAddress)
            ->where('token', $invitationToken)
            ->first();

        return $guest ? $guest->toDomain() : null;
    }

    /**
     * メールアドレスでアカウントを取得。なければNullを返す
     * @param string メールアドレス
     * @return Account AccountInterfaceを継承したクラス（Stylist or Member）
     */
    public function findAccountByEmailAddress(string $emailAddress): ?Account
    {
        $account =  $this->eloquentUser
            ->where('email', $emailAddress)
            ->first();
            
        return $account ? $account->toDomain() : null;
    }
}