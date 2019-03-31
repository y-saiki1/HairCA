<?php

namespace Packages\Domain\Repositories\Accounts\Members;

use Packages\Domain\Models\JWT\JsonWebToken;

interface MemberCommand
{
    /**
     * @param string アカウント名
     * @param string メールアドレス
     * @param string パスワード
     * @return bool
     */
    public function saveMember(string $name, string $emailAddress, string $password): bool;
}