<?php

namespace App\Domains\Models\Account\Stylist;

use App\Domains\Models\Profile\Sex;
use App\Domains\Models\Account\Account;
use App\Domains\Models\Profile\BirthDate;
use App\Domains\Models\Account\Guest\Guest;
use App\Domains\Models\Account\AccountTrait;
use App\Domains\Models\Account\Stylist\Recommender;
use App\Domains\Models\Profile\StylistProfile;

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