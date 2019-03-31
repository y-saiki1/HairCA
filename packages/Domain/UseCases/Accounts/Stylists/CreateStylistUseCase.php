<?php

namespace Packages\Domain\UseCases\Accounts\Stylists;

use Packages\Domain\Models\Account\Account;
use Packages\Domain\Models\JWT\JsonWebToken;

interface CreateStylistUseCase
{
    /**
     * @param Account アカウント
     * @param string パスワード
     * @param string 招待トークン
     * @return JsonWebToken jwt返却
     */
    public function __invoke(Account $account, string $password, string $invitationToken): JsonWebToken;
}