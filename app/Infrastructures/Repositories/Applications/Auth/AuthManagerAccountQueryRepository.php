<?php

namespace App\Infrastructures\Repositories\Applications\Auth;

use Illuminate\Auth\AuthManager;

use App\Domains\UseCases\Accounts\AccountUseCaseQuery;

use App\Domains\Models\BaseAccount\Account;
use App\Domains\Models\BaseAccount\AccountPassword;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Stylist\Guest;
use App\Domains\Models\Email\EmailAddress;
use App\Domains\Models\Hash;

use App\Infrastructures\Entities\Eloquents\EloquentGuest;

class AuthManagerAccountQueryRepository implements AccountUseCaseQuery
{
    /**
     * @var AuthManager Laravelの認証クラス
     */
    private $authManager;

    /**
     * @var EloqeuntGuest Eloqeuntゲスト
     */
    private $eloquentGuest;

    /**
     * @param AuthManager Laravelの認証クラス
     */
    public function __construct(AuthManager $authManager, EloquentGuest $eloquentGuest)
    {
        $this->authManager = $authManager;
        $this->eloquentGuest = $eloquentGuest;
    }

    /**
     * @param EmailAddress メールアドレス
     * @param AccountPassword アカウントのパスワード
     * @return mixed string JWTトークン | bool false ログイン失敗
     */
    public function login(EmailAddress $emailAddress, AccountPassword $password)
    {
        return $this->authManager
            ->guard('api')
            ->attempt([
                'email'    => $emailAddress->value(),
                'password' => $password->value(),
            ]);
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
     * @param EmailAddress $email
     * @param Hash 招待トークン
     * @return Guest ゲスト
     */
    public function findGuestByEmailAndToken(EmailAddress $emailAddress, Hash $invitationToken): Guest
    {
        $guest = $this->eloquentGuest
            ->where('email', $emailAddress->value())
            ->where('token', $invitationToken->value())
            ->get();

        return $guest->toDoamin();
    }
}