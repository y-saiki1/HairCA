<?php

namespace App\Domains\UseCases\Accounts;

use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\Stylist\Guest;

interface AccountUseCaseCommand
{
    /**
     * アカウント登録処理。パスワードを別にして渡している理由は、パスワードのハッシュ化をフレームワーク側に任せるため。
     * フレームワーク側でログインの管理を行なっている場合、平文のパスワードを渡すとフレームワークがハッシュ化を行うため（laravelはそうなっている）、ドメイン層から外す。
     * @param string アカウント名
     * @param string メールアドレス
     * @param string パスワード(平文)
     * @return bool 保存成功
     */
    public function saveStylist(string $name, string $emailAddress, string $password): bool;

    // /**
    //  * @param 
    //  */
    // public function updateMemberToStylist(): Account;

    /**
     * @param Guest ゲスト
     * @return bool
     */
    public function saveGuest(Guest $guest): bool;
}