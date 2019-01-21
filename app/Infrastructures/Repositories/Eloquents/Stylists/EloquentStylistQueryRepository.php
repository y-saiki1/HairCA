<?php

namespace App\Infrastructures\Repositories\Eloquents\Stylists;

use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseQuery;

class EloquentStylistCommandRepository implements StylistUseCaseQuery
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

        if (! $guest) throw new NotExistsException('The Guest is not invited to have this Email and Token', NotExistsException::ERROR_CODE);

        return $guest->toDomain();
    }

    /**
     * メールアドレスでGuestユーザー（招待されたユーザー）を検索し、Guestを返す
     * @param EmailAddress $email
     * @return Guest ゲスト
     * @throws NotExistsException 指定メールアドレス・パスワードを持つゲストが存在しない時に発生する。
     */
    public function findGuestByEmailAddress(string $emailAddress): Guest
    {
        $guest = $this->eloquentGuest
            ->where('email', $emailAddress)
            ->first();
        
        if (! $guest) throw new NotExistsException('The Guest is not invited to have this Email', NotExistsException::ERROR_CODE);

        return $guest->toDoamin();
    }
}