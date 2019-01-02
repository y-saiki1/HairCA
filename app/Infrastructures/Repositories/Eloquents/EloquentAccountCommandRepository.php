<?php

namespace App\Infrastructures\Repositories\Eloquents;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Domains\Models\BaseAccount\Account;
use App\Domains\Models\BaseAccount\AccountId;
use App\Domains\Models\Account\Stylist\Guest;

use App\Domains\UseCases\Accounts\AccountUseCaseCommand;

use App\Infrastructures\Entities\Eloquents\EloquentUser;
use App\Infrastructures\Entities\Eloquents\EloquentGuest;

class EloquentAccountCommandRepository implements AccountUseCaseCommand
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
     * @param EloquentUser
     * @param EloquentGuest
     */
    public function __construct(
        EloquentUser $eloquentUser, 
        EloquentGuest $eloquentGuest
    ) {
        $this->eloquentUser = $eloquentUser;
        $this->eloquentGuest = $eloquentGuest;
    }

    /**
     * @param Guest
     * @return Account Stylist or Member
     */
    public function save(Guest $account): Account
    {
        $user = $this->eloquentUser->firstOrCreate(
            [
                'name'     => $account->name()->value(),
                'email'    => $account->emailAddress()->value(),
                'password' => $account->password()->value(),
            ],
            [
                'role_id'  => $account->accountType()->value(),
            ]
        );

        return $user->toDomain();
    }

    /**
     * @param AccountId アカウントID
     * @param Guest ゲスト
     * @return bool
     */
    public function saveGuest(AccountId $accountId, Guest $guest): bool
    {
        $guest = $this->eloquentGuest->firstOrNew([
                'user_id'      => $accountId->value(),
                'email'        => $guest->emailAddress()->value(),
                'token'        => $guest->token()->value(),
                'introduction' => $guest->introduction()->value(),
        ]);

        if (! $guest->wasRecentlyCreated) {
            $guest->updated_at = Carbon::now();
        }

        return $guest->save();
    }
}