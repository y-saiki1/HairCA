<?php

namespace App\Domains\Models\Account\Stylist;

use App\Domains\Models\Hash;
use App\Domains\Models\BaseAccount\Account;
use App\Domains\Models\BaseAccount\AccountTrait;
use App\Domains\Models\Account\Stylist\Stylist;

class Guest implements Account
{
    use AccountTrait;

    // guest
    const ACCOUNT_TYPE = 0;
    const ACCOUNT_TYPE_NAME = 'Guest';
    const NOT_ACCOUNT = 0;

    /**
     * @var Stylist 招待者
     */
    private $inviter;

    /**
     * @var string 招待されるメールアドレス
     */
    private $emailAddress;

    /**
     * @var string 推薦文
     */
    private $recommendation;

    /**
     * @var Hash 招待トークン
     */
    private $token;

    /**
     * @param string 送信者名
     * @param string ゲストメールアドレス
     * @param Introduction 紹介文
     */
    public function __construct(
        Stylist $inviter,
        string $emailAddress,
        string $recommendation
    ) {
        $this->inviter = $inviter;
        $this->emailAddress = $emailAddress;
        $this->recommendation = $recommendation;

        $this->token = new Hash(uniqid(rand(), true));
    }

    /**
     * @return int アカウントではないが、アカウントとして振る舞うためtraitのメソッドをオーバーライド
     */
    public function id(): int
    {
        return self::NOT_ACCOUNT;
    }

    /**
     * @return string アカウントではないが、アカウントとして振る舞うためtraitのメソッドをオーバーライド
     */
    public function name(): string
    {
        return 'guest';
    }

    /**
     * @return string 招待者
     */
    public function inviter(): Stylist
    {
        return $this->inviter;
    }

    /**
     * @return string 招待されたメールアドレス
     */
    public function emailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @return string 推薦文
     */
    public function recommendation(): string
    {
        return $this->recommendation;
    }

    /**
     * @return string 招待トークン
     */
    public function token(): string
    {
        return $this->token->value();
    }
}