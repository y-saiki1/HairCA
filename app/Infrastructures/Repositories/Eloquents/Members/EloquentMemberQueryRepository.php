<?php

namespace App\Infrastructures\Repositories\Eloquents\Members;

// --- Domain ---
use App\Domains\Exceptions\NotExistsException;
use App\Domains\Models\Account\Member\Member;
use App\Domains\UseCases\Accounts\Members\MemberUseCaseQuery;

// --- Infra ---
use App\Infrastructures\Entities\Eloquents\EloquentAccounts\EloquentMember;

class EloquentMemberQueryRepository implements MemberUseCaseQuery
{
    /**
     * @var EloquentMember
     */
    private $eloquentMember;

    /**
     * @param EloquentMember
     * @param Hasher
     */
    public function __construct(
        EloquentMember $eloquentMember
    ) {
        $this->eloquentMember = $eloquentMember;
    }

    /**
     * @param string メールアドレス
     * @param string パスワード
     * @return Member
     * @throws NotExistsException
     */
    public function findByEmailAddressAndPassword(string $emailAddress, string $password): Member
    {
        $member = $this->eloquentMember
            ->where('email', $emailAddress)
            ->where('password', $this->accountPasswordHasher->make($password))
            ->first();

        if (! $member) throw new NotExistsException('A Member that has this credentials not exists', NotExistsException::ERROR_CODE);

        return $member->toDomain();
    }
}