<?php

namespace App\Domains\UseCases\Accounts\Members;

use App\Domains\Models\JWT\JsonWebToken;

interface MemberUseCaseCommand
{
    /**
     * @param string アカウント名
     * @param string メールアドレス
     * @param string パスワード
     * @return bool
     */
    public function saveMember(string $name, string $emailAddress, string $password): bool;
}