<?php

namespace App\Infrastructures\Repositories\Eloquents\Stylists;

// --- Application ---
use Illuminate\Contracts\Hashing\Hasher;
use Carbon\Carbon;

// --- Domain ---
// Exceptions
use App\Domains\Exceptions\NotExistsException;
// Models
use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Guest\Guest;
use App\Domains\Models\Account\Stylist\StylistProfile;
use App\Domains\Models\Profile\BirthDate;
use App\Domains\Models\Profile\Sex;
// UseCases
use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseCommand;

// --- Infra ---
// Entities
use App\Infrastructures\Entities\Eloquents\EloquentAccounts\EloquentAccount;
use App\Infrastructures\Entities\Eloquents\EloquentGuest;
use App\Infrastructures\Entities\Eloquents\EloquentStylistProfile;
use App\Infrastructures\Entities\Eloquents\EloquentRecommender;

class EloquentStylistCommandRepository implements StylistUseCaseCommand
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
        $this->EloquentAccount = $eloquentAccount;
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
     * フレームワーク側でログインの管理を行なっている場合、平文のパスワードを渡すとフレームワークがハッシュ化を行うため（laravelはそうなっている）、ドメイン層から外す。
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
                'password'  => $this->accountPasswordHasher->make($password),
            ],
            [
                'name'      => $name,
                'role_id'   => Stylist::ACCOUNT_TYPE,
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
    public function saveStylistProfile(int $accountId, string $introduction, int $baseId, BirthDate $birthDate, Sex $sex): bool
    {
        $this->eloquentStylistProfile->user_id = $accountId;
        $this->eloquentStylistProfile->introduction = $introduction;
        $this->eloquentStylistProfile->base_id = $baseId;
        $this->eloquentStylistProfile->birth_date = $birthDate->formatYMD();
        $this->eloquentStylistProfile->sex = $sex->asInt();

        return $this->eloquentStylistProfile->save();
    }
}