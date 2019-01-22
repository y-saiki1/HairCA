<?php

namespace App\Domains\Models\Account\Stylist;

use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\AccountTrait;
use App\Domains\Models\Account\Guest\Guest;
use App\Domains\Models\Account\Stylist\Recommender;
use App\Domains\Models\Account\Stylist\StylistProfile;

class Stylist implements Account
{
    use AccountTrait;

    const ACCOUNT_TYPE = 1;
    const ACCOUNT_TYPE_NAME = 'Stylist';

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
     * @param string メールアドレス
     * @param string 推薦文
     */
    public function inviteGuest(string $emailAddress, string $recommendation): Guest
    {
        return new Guest(
            new Recommender(
                $this->id(),
                $this->name(),
                $recommendation
            ),
            $emailAddress
        );
    }
}