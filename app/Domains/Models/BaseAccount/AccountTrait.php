<?php

namespace App\Domains\Models\BaseAccount;

trait AccountTrait
{
    /**
     * @return int アカウントID
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string アカウント名
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string メールアドレス
     */
    public function emailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @return bool スタイリストかどうかの判定結果
     */
    public function isStylist(): bool
    {
        return self::ACCOUNT_TYPE === 1;
    }

    /**
     * @return bool 会員かどうかの判定結果
     */
    public function isMember(): bool
    {
        return self::ACCOUNT_TYPE === 2;
    }

    /**
     * @return bool ゲストかどうかの判定結果
     */
    public function isGuest(): bool
    {
        return self::ACCOUNT_TYPE === 0;
    }

    /**
     * @return string アカウントタイプ名
     */
    public function accountTypeName(): string
    {
        return self::ACCOUNT_TYPE_NAME;
    }
}