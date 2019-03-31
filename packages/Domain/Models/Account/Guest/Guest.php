<?php

namespace Packages\Domain\Models\Account\Guest;

use Packages\Domain\Models\Hash;
use Packages\Domain\Models\Account\Account;
use Packages\Domain\Models\Account\AccountTrait;
use Packages\Domain\Models\Account\Stylist\Stylist;
use Packages\Domain\Models\Account\Stylist\Recommender;

class Guest implements Account
{
    use AccountTrait;

    // guest
    const ACCOUNT_TYPE = 0;
    const ACCOUNT_TYPE_NAME = 'Guest';
    const NOT_ACCOUNT = 0;

    /**
     * @var Recommender 招待者
     */
    private $recommender;

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
        Recommender $recommender,
        string $emailAddress
    ) {
        $this->recommender = $recommender;
        $this->emailAddress = $emailAddress;

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
     * @return Recommender 招待者
     */
    public function recommender(): Recommender
    {
        return $this->recommender;
    }

    /**
     * @return string 招待トークン
     */
    public function token(): string
    {
        return $this->token->value();
    }
}