<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Models\Account\Account;
use App\Domains\Models\JWT\JsonWebToken;

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