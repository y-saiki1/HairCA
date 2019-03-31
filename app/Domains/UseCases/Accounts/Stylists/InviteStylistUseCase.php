<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Exceptions\NotStylistException;

interface InviteStylistUseCase
{
    /**
     * ユーザーに招待メールを送る。トークン作成・保存・メール送信。
     * @param string メールアドレス
     * @param string 推薦文
     * @return InvitationToken 招待トークン
     * @throws NotStylistException
     */
    public function __invoke(string $emailAddress, string $recommendation): string;
}