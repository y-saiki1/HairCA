<?php

namespace Packages\Infrastructures\Repositories\Eloquents\Stylists;

// --- Application ---
use Illuminate\Contracts\Hashing\Hasher;
use Carbon\Carbon;

// --- Domain ---
// Exceptions
use Packages\Domain\Exceptions\NotExistsException;
// Models
use Packages\Domain\Models\Account\Account;
use Packages\Domain\Models\Account\Stylist\Stylist;
use Packages\Domain\Models\Account\Guest\Guest;
use Packages\Domain\Models\Profile\StylistProfile;
use Packages\Domain\Models\Profile\BirthDate;
use Packages\Domain\Models\Profile\Sex;
// UseCases
use Packages\Domain\Repositories\Accounts\Stylists\StylistCommand;

// --- Infra ---
// Entities
use Packages\Infrastructures\Entities\Eloquents\EloquentAccounts\EloquentAccount;
use Packages\Infrastructures\Entities\Eloquents\EloquentGuest;
use Packages\Infrastructures\Entities\Eloquents\EloquentStylistProfile;
use Packages\Infrastructures\Entities\Eloquents\EloquentRecommender;

class EloquentStylistCommand implements StylistCommand
{
    /**
     * @var EloquentGuest
     */
    private $eloquentGuest;

    /**
     * @var EloquentAccount
     */
    private $eloquentAccount;

    /**
     * @var EloquentRecommender
     */
    private $eloquentRecommender;

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
     * @param EloquentAccount
     * @param EloquentStylistProfile
     * @param Hasher
     */
    public function __construct(
        EloquentGuest $eloquentGuest,
        EloquentAccount $eloquentAccount,
        EloquentRecommender $eloquentRecommender,
        EloquentStylistProfile $eloquentStylistProfile,
        Hasher $accountPasswordHasher
    ) {
        $this->eloquentGuest = $eloquentGuest;
        $this->eloquentAccount = $eloquentAccount;
        $this->eloquentRecommender = $eloquentRecommender;
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
     * フレームワーク側でログインの管理を行なっている場合、平文のパスワードを渡すとフレームワークがハッシュ化を行うため、ドメイン層から外す。
     * @param string アカウント名
     * @param string メールアドレス
     * @param string パスワード(平文)
     * @return bool 保存成功
     */
    public function saveStylist(string $name, string $emailAddress, string $password): Stylist
    {
        $user = $this->eloquentAccount->firstOrNew(
            [
                'email'     => $emailAddress,
            ],
            [
                'name'      => $name,
                'role_id'   => Stylist::ACCOUNT_TYPE,
                'password'  => $this->accountPasswordHasher->make($password),
            ]
        );

        if (! $user->wasRecentlyCreated) {
            $user->role_id = Stylist::ACCOUNT_TYPE;
            $user->updated_at = Carbon::now();
        }
        
        $user->save();

        return $user->toDomain();
    }

    /**
     * Guestsテーブルに保存していた推薦文などをRecommenderテーブルに移行する(本登録)
     * @param int スタイリストID
     * @param Guest ゲスト
     * @return bool
     */
    public function saveRecommender(int $accountId, Guest $guest): bool
    {
        $this->eloquentRecommender->user_id = $accountId;
        $this->eloquentRecommender->recommender_id = $guest->recommender()->id();
        $this->eloquentRecommender->recommendation = $guest->recommender()->recommendation();
        
        return $this->eloquentRecommender->save();
    }

    /**
     * @param int アカウントID
     * @param string 自己紹介文
     * @param int 活動拠点ID 
     * @param BirthDate 生年月日
     * @param Sex 性別
     * @return bool
     */
    public function saveStylistProfile(int $baseId, StylistProfile $stylistProfile): bool
    {
        $this->eloquentStylistProfile->user_id = $stylistProfile->stylistId();
        $this->eloquentStylistProfile->introduction = $stylistProfile->introduction();
        $this->eloquentStylistProfile->base_id = $baseId;
        $this->eloquentStylistProfile->birth_date = $stylistProfile->birthDate();
        $this->eloquentStylistProfile->sex = $stylistProfile->sexAsInt();

        return $this->eloquentStylistProfile->save();
    }
}