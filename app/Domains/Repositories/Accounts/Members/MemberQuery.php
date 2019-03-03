<?php

namespace App\Domains\Repositories\Accounts\Members;

use App\Domains\Exceptions\NotExistsException;
use App\Domains\Models\JWT\JsonWebToken;
use App\Domains\Models\Account\Member\Member;

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