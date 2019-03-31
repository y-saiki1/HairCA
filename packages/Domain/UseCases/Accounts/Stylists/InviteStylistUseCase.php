<?php

namespace Packages\Domain\UseCases\Accounts\Stylists;

use Packages\Domain\Exceptions\NotStylistException;

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