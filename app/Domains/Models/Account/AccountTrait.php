<?php

namespace App\Domains\Models\Account;

trait AccountTrait
{
    /**
     * @var int アカウントID
     */
    private $id;

    /**
     * @var string アカウント名
     */
    private $name;

    /**
     * @var string メールアドレス
     */
    private $emailAddress;

    /**
     * @param int アカウントid
     * @param string アカウント名
     * @param string メールアドレス
     */
    public function __construct(int $id, string $name, string $emailAddress)
    {
        $this->id = $id;
        $this->name = $name;
        $this->emailAddress = $emailAddress;
    }
    
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
