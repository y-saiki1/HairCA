<?php

namespace App\Domains\Repositories\Accounts\Members;

use App\Domains\Models\JWT\JsonWebToken;

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