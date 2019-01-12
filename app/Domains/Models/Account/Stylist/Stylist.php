<?php

namespace App\Domains\Models\Account\Stylist;

use App\Domains\Models\BaseAccount\Account;
use App\Domains\Models\BaseAccount\AccountTrait;
use App\Domains\Models\Account\Stylist\Guest;
use App\Domains\Models\Account\Stylist\StylistProfile;

class Stylist implements Account
{
    use AccountTrait;

    const ACCOUNT_TYPE = 1; // Stylist
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
     * @var StylistProfile スタイリストプロフィール
     */
    private $stylistProfile;
    
    /**
     * @param int アカウントID
     * @param string アカウント名
     * @param string メールアドレス
     * @param StylistProfile スタイリストプロフィール
     */
    public function __construct(
        int $id,
        string $name,
        string $emailAddress,
        StylistProfile $stylistProfile
        
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->emailAddress = $emailAddress;
        $this->stylistProfile = $stylistProfile;
    }

    /**
     * @param string メールアドレス
     * @param string 推薦文
     */
    public function inviteGuest(string $emailAddress, string $recommendation): Guest
    {
        return new Guest(
            $this,
            $emailAddress,
            $recommendation
        );
    }
}