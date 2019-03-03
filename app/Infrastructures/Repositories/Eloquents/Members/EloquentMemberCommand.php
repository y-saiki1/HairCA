<?php

namespace App\Infrastructures\Repositories\Eloquents\Members;

// --- Application ---
use Illuminate\Contracts\Hashing\Hasher;
use Carbon\Carbon;

// --- Domain ---
use App\Domains\Models\Account\Member\Member;
use App\Domains\Repositories\Accounts\Members\MemberCommand;

// --- Infra ---
use App\Infrastructures\Entities\Eloquents\EloquentAccounts\EloquentAccount;

class EloquentMemberCommand implements MemberCommand
{
    /**
     * @var EloquentAccount
     */
    private $eloquentAccount;

    /**
     * @var Hasher
     */
    private $accountPasswordHasher;
    
    /**
     * @param EloquentAccount
     * @param Hasher
     */
    public function __construct(
        EloquentAccount $eloquentAccount,
        Hasher $accountPasswordHasher
    ) {
        $this->eloquentAccount = $eloquentAccount;
        $this->accountPasswordHasher = $accountPasswordHasher;
    }

    /**
     * @param string アカウント名
     * @param string メールアドレス
     * @param string パスワード
     * @return bool
     */
    public function saveMember(string $name, string $emailAddress, string $password): bool
    {
        $user = $this->eloquentAccount->firstOrNew(
            [
                'email'     => $emailAddress,
                'password'  => $this->accountPasswordHasher->make($password),
            ],
            [
                'name'      => $name,
                'role_id'   => Member::ACCOUNT_TYPE,
            ]
        );

        if (! $user->wasRecentlyCreated) {
            $user->role_id = Member::ACCOUNT_TYPE;
            $user->updated_at = Carbon::now();
        }
        
        return $user->save();
    }
}