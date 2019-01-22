<?php

namespace App\Domains\UseCases\Accounts\Stylists;

use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Guest\Guest;
use App\Domains\Models\Account\Stylist\StylistProfile;

interface StylistUseCaseCommand
{
    /**
     * @param Guest ゲスト
     * @return bool
     */
    public function saveGuest(Guest $guest): bool;
    
    /**
     * アカウント登録処理。パスワードを別にして渡している理由は、パスワードのハッシュ化をフレームワーク側に任せるため。
     * フレームワーク側でログインの管理を行なっている場合、平文のパスワードを渡すとフレームワークがハッシュ化を行うため（laravelはそうなっている）、ドメイン層から外す。
     * @param string アカウント名
     * @param string メールアドレス
     * @param string パスワード(平文)
     * @return bool 保存成功
     */
    public function saveStylist(string $name, string $emailAddress, string $password): Stylist;

    /**
     * @param int スタイリストID
     * @param Guest ゲスト
     */
    public function saveStylistProfile(int $accountId, Guest $guest): bool;
    
    /**
     * @param int アカウントID
     * @param string 自己紹介文
     * @param DateTime 生年月日
     * @param int 性別
     * @param string 都道府県
     * @return bool
     */
    public function updateStylistProfile(int $accountId, string $introduction, \DateTime $birthDate, int $sex, string $prefecture): bool;
}