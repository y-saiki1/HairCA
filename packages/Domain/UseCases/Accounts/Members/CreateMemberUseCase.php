<?php

namespace Packages\Domain\UseCases\Accounts\Members;

use Packages\Domain\Models\JWT\JsonWebToken;

interface CreateMemberUseCase
{
    /**
     * @param string アカウント名
     * @param string メールアドレス
     * @param JsonWebToken
     */
    public function __invoke(string $name, string $emailAddress, string $password): JsonWebToken;
}