<?php

namespace Packages\Domain\Repositories\Accounts\Stylists;

// --- Domain ---
use Packages\Domain\Models\Account\Account;
use Packages\Domain\Models\Account\Stylist\Stylist;
use Packages\Domain\Models\Account\Guest\Guest;
use Packages\Domain\Models\Profile\StylistProfile;
use Packages\Domain\Models\Profile\BirthDate;
use Packages\Domain\Models\Profile\Sex;

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