<?php

namespace App\Infrastructures\Repositories\Eloquents\Stylists;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Hashing\Hasher;
use Carbon\Carbon;

use App\Domains\Exceptions\NotExistsException;

use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Guest\Guest;
use App\Domains\Models\Account\Stylist\StylistProfile;

use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseCommand;

use App\Infrastructures\Entities\Eloquents\EloquentUser;
use App\Infrastructures\Entities\Eloquents\EloquentGuest;
use App\Infrastructures\Entities\Eloquents\EloquentStylistProfile;

class EloquentStylistCommandRepository implements StylistUseCaseCommand
{
    /**
     * @var EloquentGuest
     */
    private $eloquentGuest;

    /**
     * @var EloquentUser
     */
    private $eloquentUser;

    /**
     * @var EloquentStylistProfile
     */
    private $eloquentStylistProfile;

    /**
     * @var Hasher
     */
    private $accountPasswordHasher;

    /**
     * @param EloquentGuest
     * @param EloquentUser
     * @param EloquentStylistProfile
     * @param Hasher
     */
    public function __construct(
        EloquentGuest $eloquentGuest,
        EloquentUser $eloquentUser,
        EloquentStylistProfile $eloquentStylistProfile,
        Hasher $accountPasswordHasher
    ) {
        $this->eloquentGuest = $eloquentGuest;
        $this->eloquentUser = $eloquentUser;
        $this->eloquentStylistProfile = $eloquentStylistProfile;
        $this->accountPasswordHasher = $accountPasswordHasher;
    }

    /**
     * 招待したメールアドレスとトークンを保存する
     * @param Guest ゲスト
     * @return bool
     */
    public function saveGuest(Guest $guest): bool
    {
        $eloquentGuest = $this->eloquentGuest->firstOrNew(
            [
                'user_id'        => $guest->recommender()->id(),
                'email'          => $guest->emailAddress(),
            ],
            [
                'token'          => $guest->token(),
                'recommendation' => $guest->recommender()->recommendation(),
            ]
        );

        if (! $eloquentGuest->wasRecentlyCreated) {
            $eloquentGuest->token = $guest->token();
            $eloquentGuest->updated_at = Carbon::now();
        }

        return $eloquentGuest->save();
    }

    /**
     * アカウント登録処理。パスワードを別にして渡している理由は、パスワードのハッシュ化をフレームワーク側に任せるため。
     * フレームワーク側でログインの管理を行なっている場合、平文のパスワードを渡すとフレームワークがハッシュ化を行うため（laravelはそうなっている）、ドメイン層から外す。
     * @param string アカウント名
     * @param string メールアドレス
     * @param string パスワード(平文)
     * @return bool 保存成功
     */
    public function saveStylist(string $name, string $emailAddress, string $password): Stylist
    {
        $user = $this->eloquentUser->firstOrNew(
            [
                'email'     => $emailAddress,
                'password'  => $this->accountPasswordHasher->make($password),
            ],
            [
                'name'      => $name,
                'role_id'   => Stylist::ACCOUNT_TYPE,
            ]
        );

        if (! $user->wasRecentlyCreated) {
            $user->updated_at = Carbon::now();
        }
        
        $user->save();

        return $user->toDomain();
    }

    /**
     * @param int スタイリストID
     * @param Guest ゲスト
     */
    public function saveStylistProfile(int $accountId, Guest $guest): bool
    {
        $this->EloquentStylistProfile->user_id = $accountId;
        $this->EloquentStylistProfile->recommender_id = $guest->recommender()->id();
        $this->EloquentStylistProfile->recommendation = $guest->recommender()->recommendation();
        
        return $this->EloquentStylistProfile->save();
    }

    /**
     * @param int アカウントID
     * @param string 自己紹介文
     * @param DateTime 生年月日
     * @param int 性別
     * @param string 都道府県
     * @return bool
     */
    public function updateStylistProfile(int $accountId, string $introduction, \DateTime $birthDate, int $sex, string $prefecture): bool
    {
        $this->EloquentStylistProfile->user_id = $user->id;
        $this->EloquentStylistProfile->recommender_id = $guest->recommender()->id();
        $this->EloquentStylistProfile->recommendation = $guest->recommender()->recommendation();
        $this->EloquentStylistProfile->introduction = $introduction;
        $this->EloquentStylistProfile->age = $age;
        $this->EloquentStylistProfile->sex = $sex;

        return $this->EloquentStylistProfile->save();
    }
}