<?php

namespace App\Domains\Models\Account;

interface Account
{
    /**
     * @return int アカウントID
     */
    public function id(): int;

    /**
     * @return AccountName アカウント名
     */
    public function name(): string;

    /**
     * @return EmailAddress メールアドレス
     */
    public function emailAddress(): string;

    /**
     * @return bool スタイリストかどうかの判定結果
     */
    public function isStylist(): bool;

    /**
     * @return bool 会員かどうかの判定結果
     */
    public function isMember(): bool;

    /**
     * @return bool ゲストかどうかの判定結果
     */
    public function isGuest(): bool;

    /**
     * @return string アカウントタイプ名
     */
    public function accountTypeName(): string;
}
