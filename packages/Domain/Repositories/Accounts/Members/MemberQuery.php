<?php

namespace Packages\Domain\Repositories\Accounts\Members;

use Packages\Domain\Exceptions\NotExistsException;
use Packages\Domain\Models\JWT\JsonWebToken;
use Packages\Domain\Models\Account\Member\Member;

interface MemberQuery
{
    /**
     * @param string メールアドレス
     * @param string パスワード
     * @return Member
     * @throws NotExistsException
     */
    public function findByEmailAddressAndPassword(string $emailAddress, string $password): Member;
}