<?php

namespace App\Domains\UseCases\Accounts\Members;

use App\Domains\Exceptions\NotExistsException;
use App\Domains\Models\JWT\JsonWebToken;
use App\Domains\Models\Account\Member\Member;

interface MemberUseCaseQuery
{
    /**
     * @param string メールアドレス
     * @param string パスワード
     * @return Member
     * @throws NotExistsException
     */
    public function findByEmailAddressAndPassword(string $emailAddress, string $password): Member;
}