<?php

namespace App\Infrastructures\Repositories\Applications\Auth;

use Illuminate\Auth\AuthManager;
use App\Exceptions\NotExistsException;

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
        if (! $token) throw new NotExistsException('Failed to login');

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
     * メールアドレスと招待トークンでGuestユーザー（招待されたユーザー）を検索し、Guestを返す
     * @param string $email
     * @param string 招待トークン
     * @return Guest ゲスト
     */
    public function findGuestByEmailAddressAndToken(string $emailAddress, string $invitationToken): Guest
    {
        $guest = $this->eloquentGuest
            ->where('email', $emailAddress)
            ->where('token', $invitationToken)
            ->first();

        if (! $guest) throw new NotExistsException('The Guest is not invited to have this Email and Token');

        return $guest->toDomain();
    }

    /**
     * メールアドレスでアカウントを取得。
     * @param string メールアドレス
     * @return Account AccountInterfaceを継承したクラス（Stylist or Member）
     */
    public function findAccountByEmailAddress(string $emailAddress): Account
    {
        $account =  $this->eloquentUser
            ->where('email', $emailAddress)
            ->first();

        if (! $account) throw new NotExistsException('An Account that have this Email is not exists');

        return $account->toDomain();
    }
}