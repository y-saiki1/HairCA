<?php

namespace App\Domains\Models\BaseAccount;

use App\Domains\Models\BaseAccount\AccountId;
use App\Domains\Models\BaseAccount\AccoutName;
use App\Domains\Models\BaseAccount\AccountPassword;
use App\Domains\Models\BaseAccount\AccountType;
use App\Domains\Models\Account\Stylist\Stylist;

use App\Domains\Models\Email\EmailAddress;

class Account
{
    /**
     * @var AccountId アカウントID
     */
    protected $id;

    /**
     * @var AccountName アカウント名
     */
    protected $name;

    /**
     * @var EmailAddress メールアドレス
     */
    protected $emailAddress;

    /**
     * @var AccountPassword アカウントパスワード
     */
    protected $password;

    /**
     * @var AccountType アカウントタイプ
     */
    protected $accountType;

    /**
     * @param AccountId
     * @param AccountName
     * @param EmailAddress
     * @param AccountType
     */
    public function __construct(
        AccountId $id,
        AccountName $name,
        EmailAddress $emailAddress,
        AccountType $accountType
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->emailAddress = $emailAddress;
        $this->accountType = $accountType;
    }

    // /**
    //  * @return array Accountの配列
    //  */
    // abstract public function toArray(): array;

    /**
     * @return AccountId アカウントID
     */
    public function id(): AccountId
    {
        return $this->id;
    }

    /**
     * @return AccountName アカウント名
     */
    public function name(): AccountName
    {
        return $this->name;
    }

    /**
     * @return EmailAddress メールアドレス
     */
    public function emailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    /**
     * 
     */
    public function getAccountType(): Account
    {
        if (Stylist::ACCOUNT_TYPE === $this->accountType->value()) {
            return new Stylist(
                $this->id,
                $this->name,
                $this->emailAddress,
                $this->accountType
            );
        }
    }
}
