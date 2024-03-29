<?php

namespace Packages\Infrastructures\Repositories\Eloquents\Members;

// --- Domain ---
use Packages\Domain\Exceptions\NotExistsException;
use Packages\Domain\Models\Account\Member\Member;
use Packages\Domain\Repositories\Accounts\Members\MemberQuery;

// --- Infra ---
use Packages\Infrastructures\Entities\Eloquents\EloquentAccounts\EloquentMember;

class EloquentMemberQuery implements MemberQuery
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