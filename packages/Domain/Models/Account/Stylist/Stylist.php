<?php

namespace Packages\Domain\Models\Account\Stylist;

use Packages\Domain\Models\Profile\Sex;
use Packages\Domain\Models\Account\Account;
use Packages\Domain\Models\Profile\BirthDate;
use Packages\Domain\Models\Account\Guest\Guest;
use Packages\Domain\Models\Account\AccountTrait;
use Packages\Domain\Models\Account\Stylist\Recommender;
use Packages\Domain\Models\Profile\StylistProfile;

class Stylist implements Account
{
    use AccountTrait;

    const ACCOUNT_TYPE = 1;
    const ACCOUNT_TYPE_NAME = 'Stylist';

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

    /**
     * スタイリストのプロフィールを作成する
     * @param string 自己紹介文
     * @param BirthDate 
     * @param Sex
     */
    public function createProfile(string $introduction, BirthDate $birthDate, Sex $sex): StylistProfile
    {
        return new StylistProfile(
            $this,
            $introduction,
            $birthDate,
            $sex
        );
    }
}