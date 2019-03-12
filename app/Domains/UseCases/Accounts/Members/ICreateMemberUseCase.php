<?php

namespace App\Domains\UseCases\Accounts\Members;

use App\Domains\Models\JWT\JsonWebToken;

interface ICreateMemberUseCase
{
    /**
     * @param string アカウント名
     * @param string メールアドレス
     * @param JsonWebToken
     */
    public function __invoke(string $name, string $emailAddress, string $password): JsonWebToken;
}