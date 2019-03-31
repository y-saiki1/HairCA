<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Models\Account\Account;

interface AuthenticateInvitationUseCase
{
    /**
     * 招待認証機能。
     * ゲスト招待されており、すでに会員だったら自分のAccount(Member or Stylist)を返す。
     * 会員でなければゲストを返す。
     * @param string メールアドレス
     * @param string 招待トークン
     * @param Account Guest | Stylist | Member
     */
    public function __invoke(string $emailAddress, string $invitationToken): Account;
}