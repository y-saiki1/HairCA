<?php

namespace App\Domains\Repositories\Accounts\Stylists;

// --- Domain ---
use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Guest\Guest;
use App\Domains\Models\Profile\StylistProfile;
use App\Domains\Models\Profile\BirthDate;
use App\Domains\Models\Profile\Sex;

interface StylistCommand
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
     * Guestsテーブルに保存していた推薦文などをRecommenderテーブルに移行する(本登録)
     * @param int スタイリストID
     * @param Guest ゲスト
     * @return bool
     */
    public function saveRecommender(int $accountId, Guest $guest): bool;
    
    /**
     * @param int アカウントID
     * @param string 自己紹介文
     * @param int 活動拠点ID 
     * @param BirthDate 生年月日
     * @param Sex 性別
     * @return bool
     */
    public function saveStylistProfile(int $baseId, StylistProfile $stylistProfile): bool;
}