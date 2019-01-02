<?php

namespace App\Domains\Models\Account\Member;

use App\Domains\Models\BaseAccount\AccountId;
use App\Domains\Models\BaseAccount\AccoutName;
use App\Domains\Models\BaseAccount\AccountPassword;
use App\Domains\Models\BaseAccount\AccoutHashedPassword;

use App\Domains\Models\Email\EmailAddress;

class Member extends Account
{
    /**
     * @var AccountId $id
     */
    private $id;

    /**
     * @var AccountName $accountName
     */
    private $accountName;

    /**
     * @var EmailAddress $emailAddress
     */
    private $emailAddress;

    /**
     * @param AccountId $id
     * @param AccountName $accountName
     * @param EmailAddress $emailAddress
     */
    public function __construct(AccountId $id, AccountName $accountName, EmailAddress $emailAddress)
    {
        $this->id = $id;
        $this->accountName = $accountName;
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return array Memberの配列
     */
    public function toArray(): array
    {
        return [
            
        ]; 
    }

    /**
     * @return AccountId $id
     */
    public function id(): AccountId
    {
        return $this->id;
    }

    /**
     * @return AccountName $accountName
     */
    public function accountName(): AccountName
    {
        return $this->accountName;
    }

    /**
     * @return EmailAdress $emailAddress
     */
    public function emailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }
}
