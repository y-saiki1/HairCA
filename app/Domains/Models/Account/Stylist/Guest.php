<?php

namespace App\Domains\Models\Account\Stylist;

use App\Domains\Models\Hash;
use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\AccountTrait;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domain\Models\Account\Stylist\Recommender;

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
        Recommender $recommender,
        string $emailAddress,
        string $recommendation
    ) {
        $this->recommender = $recommender;
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
     * @return Recommender 招待者
     */
    public function recommender(): Recommender
    {
        return $this->recommender;
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