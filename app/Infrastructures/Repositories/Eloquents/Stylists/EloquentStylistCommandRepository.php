<?php

namespace App\Infrastructures\Repositories\Eloquents\Stylists;

use Illuminate\Contracts\Hashing\Hasher;
use Carbon\Carbon;

use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Stylist\Guest;
use App\Domains\Models\Account\Stylist\StylistProfile;

use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseCommand;

use App\Infrastructures\Entities\Eloquents\EloquentUser;
use App\Infrastructures\Entities\Eloquents\EloquentGuest;

class EloquentStylistCommandRepository implements StylistUseCaseCommand
{
    /**
     * @var EloquentUser
     */
    private $eloquentUser;

    /**
     * @var EloquentGuest
     */
    private $eloquentGuest;

    /**
     * @var Hasher
     */
    private $accountPasswordHasher;

    /**
     * @param EloquentUser
     * @param EloquentGuest
     * @param Hasher
     */
    public function __construct(
        EloquentUser $eloquentUser, 
        EloquentGuest $eloquentGuest,
        Hasher $accountPasswordHasher
    ) {
        $this->eloquentUser = $eloquentUser;
        $this->eloquentGuest = $eloquentGuest;
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
                'recommendation' => $guest->recommendation(),
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
    public function saveStylist(string $name, string $emailAddress, string $password): bool
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

        return $user->save();
    }

    /**
     * @param int アカウントID
     * @param StylistProfile スタイリストプロフィール
     * @return bool
     */
    public function saveStylistProfile(int $accountId, StylistProfile $stylistProfile): bool
    {
        $this->EloquentStylistProfile->user_id = $accountId;
        $this->EloquentStylistProfile->recommender_id = $stylistProfile->recommender()->id();
        $this->EloquentStylistProfile->recommendation = $stylistProfile->recommendation();

        return $this->EloquentStylistProfile->save();
    }
}